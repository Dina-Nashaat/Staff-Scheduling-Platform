<?php

namespace App\Http\Controllers;

use Request;
use App\Availability;
use Auth;
use \Datetime;

class availabilityController extends Controller
{
    function store()
    {
        $input = Request::all();
        $data['user_id'] = $input['userId'];
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
        $query = Availability::where('user_id',$user_id)->get();
        $data = [];
        foreach($query as $q)
        {
            $date = $q->date;
            $start = $date.' '.$q->start_time;
            $end = $date.' '.$q->end_time;
            $id = $q->id;

            $data[] = array('start'=>$start,
                            'end' =>$end,
                            'title' => 'available', 
                            'id'=>$id);
        }

        return json_encode($data);
    }
}   
