<?php

namespace App\Http\Controllers;

use Request;
use App\Availability;

class availabilityController extends Controller
{
    function store()
    {
        $input = Request::all();
        $data['user_id'] = 1;
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
}
