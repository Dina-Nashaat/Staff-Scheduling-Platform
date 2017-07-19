<?php

namespace App\Http\Controllers;

use Request;
use App\Availability;
use App\Schedule;
use Auth;
use \Datetime;

class AvailabilityController extends Controller
{
    function store()
    {
        $input = Request::all();
        $data['user_id'] = Auth::user()->id;
        $data['date'] = $input['Date'];
        $data['start_time'] = $input['startTime'];
        $data['end_time'] = $input['endTime'];
        $availability = Availability::create($data);
        return $availability->id;
    }

    function update()
    {
        $input = Request::all();
        $availability = Availability::find($input['id']);
        $data['date'] = $input['Date'];
        $data['start_time'] = $input['startTime'];
        $data['end_time'] = $input['endTime'];
        $availability->update($data);
    }

    function fetch()
    {
        $user_id = Auth::user()->id;
        $query = Availability::where('user_id', $user_id)->get();
        $data = [];
        foreach($query as $q)
        {
            $date = $q->date;
            $start = $date.' '.$q->start_time;
            $end = $date.' '.$q->end_time;
            $id = $q->id;

            $data[] = array('start'=>$start,
                            'end' =>$end,
                            'title' => 'Available', 
                            'id'=>$id);
        }
        return json_encode($data);
    }

    function delete()
    {   
        $input = Request::all();
        $availability = Availability::find($input['id']);
        $availability->delete();
        return $availability;
    }

    function view()
    {
        return view('home.view');
    }

    function get()
    {
        $input = Request::all();
        $availabilities = Availability::where('date', $input['eventdate'])->get();
        $events = Schedule::where('event_date', $input['eventdate'])->get();
        $users = array();
        foreach ($availabilities as $availability) {
            array_push($users, $availability->user);
        }
        $arr = array();
        
        $arr['events'] = $events;
        $arr['availabilities'] = $availabilities;
        
        return $arr;
    }

    function availableAtTime()
    {
        $input = Request::all();

        $condition = [['date','=',$input['event_date']],
            ['start_time','<=',$input['start_time']],
            ['end_time','>=',$input['end_time']]];

        $availabilities = Availability::where($condition)->get();
         $users = array();
        foreach ($availabilities as $availability) {
            array_push($users, $availability->user);
        }
        return $availabilities;
    }
}   

