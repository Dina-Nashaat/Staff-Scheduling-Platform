<?php

namespace App\Http\Controllers;
use Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home/index');
    }

    public function minor()
    {
        return view('home/minor');
    }
    public function getAvailability()
    {
        return view('home/availability');
    }

    public function postAvailability(Request $request)
    {
        $input = Request::all();
        dd($input);
        return $input;
    }
}
