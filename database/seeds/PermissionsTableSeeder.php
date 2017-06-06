<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
                    ['permission_name'=>'set_availability',
                    'description'=> "Set user's own available time and dates."],
                    ['permission_name'=>'get_availability',
                    'description'=> "Get user's available time and date."],
                    ['permission_name'=>'get_availability_all',
                    'description'=> 'Get availability of all users'],
                    ['permission_name'=>'delete_availability',
                    'description'=> 'delete a specifiec availability for one user'],
                    
                    ['permission_name'=>'set_schedule_all',
                    'description'=> 'Set schedule for all users.'],
                    ['permission_name'=>'add_event',
                    'description'=> "Add a new event to the schedule."],
                    ['permission_name'=>'delete_event',
                    'description'=> "Delete an event from the schedule."],
                    ['permission_name'=>'edit_event',
                    'description'=> "Edit an event in the schedule."],
                    ['permission_name'=>'get_schedule',
                    'description'=> "Get user's own schedule with all its details."],
                    ['permission_name'=>'get_schedule',
                    'description'=> "Get user's own schedule with all its details."],
                    ['permission_name'=>'get_schedule_all',
                    'description'=> 'Get schedule of all users'],
                    ['permission_name'=>'assign_staff',
                    'description'=> 'Assign staff to an event.'],
                    

                    ['permission_name'=>'add_user',
                    'description'=> 'Add a new user to the system.'],
                    ['permission_name'=>'delete_user',
                    'description'=> 'Delete a user from the system.'],
                    ['permission_name'=>'edit_user',
                    'description'=> 'Edit a user in the system.'],
                    ['permission_name'=>'view_users',
                    'description'=> 'View all users using the system'],
                    ['permission_name'=>'view_YLAs',
                    'description'=> 'View only YLAs in the system'],
                 ];
        foreach($permissions as $permission){
            Permission::create($permission);
        }
    }
}