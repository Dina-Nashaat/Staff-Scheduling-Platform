<?php

namespace App\Http\Controllers;


use Request;
use App\Schedule;
use App\User;
use Auth;
use \Datetime;

class ScheduleController extends Controller
{

    public function getSchedule()
    {
        return view('home/schedule');
    }

    function store()
    {
        
        $input = Request::all();
        $assigned = $input['assigned'];
        $array =[];
        $users = [];
        
        $schedule = Schedule::create($input);

        //Update the schedule_user table in case 
        //YLAs are scheduled
        if(!empty($assigned))
        {
            $array = explode(',', $assigned);
        }
        foreach($array as $assigned_id)
        {
            $user = User::find($assigned_id);
            array_push($users,$user->id);
            $eventId = $schedule->id;
        }   
        $duplicate = self::assignYLA($users, $schedule);
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
        $schedule->update($input);

         if(isset($input['assigned']))
         {
            $assigned = $input['assigned'];
            $assigned_array = [];
            if(!empty($assigned))
                $assigned_array = explode(',', $assigned);
            $duplicate = self::assignYLA($assigned_array, $schedule);
        }
        return $schedule;
    }

    function delete()
    {   
        $input = Request::all();
        $schedule = Schedule::find($input['id']);
        $schedule->delete();
        return $schedule;
    }

    function assignYLA($users,$schedule)
    {
        $duplicate = 0;
        $schedule->users()->sync($users);
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
    
    function getScheduled(){
        $input = Request::all();
        $schedule = Schedule::find($input['eventId']);
        $assigned = [];
        foreach($schedule->users as $user)
        {
          array_push($assigned,$user->id);
        }
        return $assigned;
    }

}
