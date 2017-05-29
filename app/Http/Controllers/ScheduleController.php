<?php

namespace App\Http\Controllers;


use Request;
use App\Schedule;
use App\User;
use Auth;
use \Datetime;

class ScheduleController extends Controller
{
    function store()
    {
        
        $input = Request::all();
        $assigned = $input['assigned'];
        $array =[];
        
        $schedule = Schedule::create($input);
        if(!empty($assigned))
        {
            $array = explode(',', $assigned);
        }
        foreach($array as $assigned_id)
        {
            $user = User::find($assigned_id);
            $eventId = $schedule->id;
            $duplicate = self::assignYLA($user, $eventId);
        }   
        return $schedule->id;
    }

    function fetch()
    {
        $query = Schedule::all();
        $data = [];
        foreach($query as $q)
        {
            $date = $q->event_date;
            $start = $date.' '.$q->start_time;
            $end = $date.' '.$q->end_time;
            $title = $q->event_name;
            $id = $q->id;
            $color = $q->event_color;
            $data[] = array('start'=>$start,
                            'end' =>$end,
                            'title' => $title,
                            'color' => $color,
                            'id'=>$id);
        }
        return json_encode($data);
    }

    function update()
    {
        $input = Request::all();
        $schedule = Schedule::find($input['id']);
        $data['eventDate'] = $input['Date'];
        $data['start_time'] = $input['startTime'];
        $data['end_time'] = $input['endTime'];
        $data['event_color'] = $input['event_color'];
        $schedule->update($data);
    }
        
    public function getSchedule()
    {
        return view('home/schedule');
    }

    function delete()
    {   
        $input = Request::all();
        $schedule = Schedule::find($input['id']);
        $schedule->delete();
        return $schedule;
    }

	function assign()
    {
        $input = Request::all();
        $user = User::find($input['userID']);
        $eventId = $input['eventID'];
        $duplicate = self::assignYLA($user, $eventId);
        return $duplicate;
    }

    function assignYLA($user,$eventId)
    {
          //$duplicate = 0;
        if (!$user->schedules->contains($eventId)) {
          $user->schedules()->attach($eventId);
          $duplicate = 0;
        }else $duplicate = 1;
        return $duplicate;
    }
    function checkIfUserScheduled(){
        $input = Request::all();
        $user = User::find($input['userID']);
        if (!$user->schedules->contains($input['eventID'])) 
            $exists = 0;
        else
            $exists = 1;
        return $exists;
    }
}
