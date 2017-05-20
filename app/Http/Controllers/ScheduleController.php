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
        $data['eventName'] = $input['eventName'];
        $data['eventDate'] = $input['eventDate'];
        $data['start_time'] = $input['startTime'];
        $data['end_time'] = $input['endTime'];
        $schedule = Schedule::create($data);
        return $schedule->id;
    }

    function fetch()
    {
        $query = Schedule::all();
        $data = [];
        foreach($query as $q)
        {
            $date = $q->eventDate;
            $start = $date.' '.$q->start_time;
            $end = $date.' '.$q->end_time;
            $title = $q->eventName;
            $id = $q->id;

            $data[] = array('start'=>$start,
                            'end' =>$end,
                            'title' => $title,
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

        //$duplicate = 0;
        if (!$user->schedules->contains($input['eventID'])) {
          $user->schedules()->attach($input['eventID']);
          $duplicate = 0;
        }else $duplicate = 1;
        
        return $duplicate;

    }
}
