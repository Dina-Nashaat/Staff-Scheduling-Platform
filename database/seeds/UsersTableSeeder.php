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

        $user = User::create([	
        	'firstname' => 'Developer',
	        'lastname' => 'Developer',
	        'birthdate' => Carbon::now(),
	        'email' => 'dev@bc.com',
	        'password' => bcrypt('12345678'),
	        'center_id' => '1',
	        'state' => 'active',

        ]);
        $role = App\Role::where('role_name','Super Admin')->first();
        $role->users()->save($user);
    }
}
