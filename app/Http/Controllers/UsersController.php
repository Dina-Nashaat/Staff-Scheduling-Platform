<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;


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

	public function edit($userId)
    {
		$user = User::find($userId);
		return view('users.create', compact('user'));
    }

    public function store(Request $request){
		try{
				$rules = [
					'firstname' => 'required',
					'lastname' => 'required',
					'email' => 'email|required',
					'password' => 'min:8|confirmed|required',
					'birthdate' => 'required'
				];

				$data = $request->all();
				
				if(!(int)$data['user_id']){	
					$this->validate($request, $rules);
					$data['state'] = 'active';
					$data['password'] = bcrypt($data['password']);
					$data['center_id'] = 1;

					$user = User::create($data);

					$role = Role::where('role_name','Part-Time')->first();
					$role->users()->save($user);
				}
				else{
					$user = User::find((int)$data['user_id']);
					$user->update($data);
				}
				return redirect()->route('users')->with('success', 'User has been added successfully!');
		}catch (\Illuminate\Database\QueryException $e) {	

				return redirect()->back()->withInput()->with('message', 'User has not been added, Try again!');
				
	  	}

    }
}
