<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
    	$users = User::all();
    	return view('users.index', compact('users'));
    }

    public function create()
    {
    	return view('users.create');
    }

    public function store(Request $request){
    	try {
			$rules = [
				'firstname' => 'required',
				'lastname' => 'required',
				'email' => 'email|required',
				'password' => 'min:8|confirmed|required',
				'birthdate' => 'required'
			];

			$this->validate($request, $rules);

			$data = $request->all();
			$data['state'] = 'active';
			$data['password'] = bcrypt($data['password']);
			$data['center_id'] = 1;
			$data['role_id'] = 1;

			User::create($data);

        	return redirect()->route('users')->with('success', 'User has been added successfully!');
      } catch (\Illuminate\Database\QueryException $e) {
        	return redirect()->back()->withInput()->with('message', 'User has not been added, Try again!');
      }

    }
}
