<?php

namespace App\Http\Controllers;
use Request;
use Carbon\Carbon;

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
	
	public function adminViewAvailability()
    {
        return view('home/adminViewAvailability');
    }

    public function postAvailability(Request $request)
    {
        $input = Request::all();
        return $input;
    }
    public function updateAvailability(Request $request)
    {
        $input = Request::all();
        return $input;
    }
}
