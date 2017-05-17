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
    public function postAvailability()
    {
        $input = Request::all();
        return $input;
    }
    public function trial()
    {
        $input = Request::all();
        return $input;
    }
}
