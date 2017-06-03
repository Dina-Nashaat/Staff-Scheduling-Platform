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
                    ['permission_name'=>'schedule_admin',
                    'slug'=> json_encode(['create'=>true, 
                              'edit'=>true, 
                              'delete'=>true,
                              'view'=>true])
                    ],
                    ['permission_name'=>'schedule_parttime',
                    'slug'=> json_encode(['create'=>false, 
                              'edit'=>false, 
                              'delete'=>false,
                              'view'=>true])
                    ],
                    ['permission_name'=>'available',
                    'slug'=> json_encode(['create'=>true, 
                              'edit'=>true, 
                              'delete'=>true,
                              'view'=>true])
                    ],
                    ['permission_name'=>'admin_panel',
                    'slug'=> json_encode(['create'=>true,
                              'edit'=>true, 
                              'delete'=>true,
                              'view'=>true])
                    ],
                    ['permission_name'=>'super_panel',
                    'slug'=> json_encode(['create'=>true, 
                              'edit'=>true, 
                              'delete'=>true,
                              'view'=>true])
                    ],
                 ];
        foreach($permissions as $permission){
            Permission::create($permission);
        }
    }
}