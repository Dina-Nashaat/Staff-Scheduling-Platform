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
        Availability::create($data);
        return $data;
    }
}
