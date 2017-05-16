<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
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
        User::create([	
        	'firstname' => 'Developer',
	        'lastname' => 'Developer',
	        'birthdate' => Carbon::now(),
	        'email' => 'dev@bc.com',
	        'password' => bcrypt('12345678'),
	        'center_id' => '1',
	        'state' => 'active',
	        'role_id' => '1',
        ]);
    }
}
