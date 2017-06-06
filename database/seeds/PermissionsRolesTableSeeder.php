<?php

use Illuminate\Database\Seeder;

class PermissionsRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //key: permission_name, value: id
        $permissions = App\Permission::pluck('id','permission_name')->toArray();
        
        $super_admin = App\Role::where('role_name','Super Admin')->first();
        $admin = App\Role::where('role_name','Admin')->first();
        $part_time = App\Role::where('role_name','Part-Time')->first();
        
        //Give super admin and admin all permissions
        foreach($permissions as $permission)
        {
            $super_admin->permissions()->attach($permission);
            $admin->permissions()->attach($permission);
        }

        //Give Part-Time selected permissions
        $part_time->permissions()->attach([
            $permissions["set_availability"],
            $permissions["get_availability"],
            $permissions["get_schedule"],
            $permissions["get_schedule_all"]
        ]);

    }
}
