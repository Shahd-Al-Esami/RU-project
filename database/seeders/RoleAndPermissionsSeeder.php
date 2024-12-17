<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $AdminPermissions = [
            'create-users',
            'edit-users',
            'delete-users',
            'view-users',
        ];

        foreach($AdminPermissions as $permission){
            Permission::create(['name'=>$permission]);
        }
         $admin=Role::create(['name' => 'admin']);
         $admin->givePermissionTo($AdminPermissions);
         $doctor=Role::create(['name' => 'doctor']);

         $patient=Role::create(['name' => 'patient']);


    }
}
