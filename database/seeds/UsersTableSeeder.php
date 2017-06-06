<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Role;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [	
        	'firstname' => 'Developer',
	        'lastname' => 'Developer',
	        'birthdate' => Carbon::now(),
	        'email' => 'dev@bc.com',
	        'password' => bcrypt('12345678'),
	        'center_id' => '1',
	        'state' => 'active',],

            [	
        	'firstname' => 'Dina',
	        'lastname' => 'Nashaat',
	        'birthdate' => Carbon::now(),
	        'email' => 'dina.nashaat@gmail.com',
	        'password' => bcrypt('12345678'),
	        'center_id' => '1',
	        'state' => 'active',],

            [	
        	'firstname' => 'John',
	        'lastname' => 'Adams',
	        'birthdate' => Carbon::now(),
	        'email' => 'john.adams@gmail.com',
	        'password' => bcrypt('12345678'),
	        'center_id' => '1',
	        'state' => 'active',]

        ];
         foreach($users as $key=>$user){
            $user_c = User::create($user);
            $role = App\Role::where('id',$key+1)->first();
            $role->users()->save($user_c);
        }
    }
}
