<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
                    ['role_name'=>'Super Admin',
                    'role_description'=>'Technical User with all permissions enabled'],
                    ['role_name'=>'Admin',
                    'role_description'=>'Staff with highest permissions to create/delete/edit users and
                                        create/edit schedules'],
                    ['role_name'=>'Part-Time',
                     'role_description'=>'User with permissions to create availability and view final schedule'],
                 ];
        
        foreach($roles as $role){
            Role::create($role);
        }
    }
}
