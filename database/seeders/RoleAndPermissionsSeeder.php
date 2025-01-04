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

        $DoctorPermissions =[

        ];

        $PatientPermissions =[

        ];

        foreach($AdminPermissions as $permission){
            Permission::create(['name'=>$permission]);
        }
         $admin=Role::create(['name' => 'admin']);
         $admin->givePermissionTo($AdminPermissions);

         foreach($DoctorPermissions as $permission){
            Permission::create(['name'=>$permission]);
        }

         $doctor=Role::create(['name' => 'doctor']);
         $doctor->givePermissionTo($DoctorPermissions);

         foreach($PatientPermissions as $permission){
            Permission::create(['name'=>$permission]);
        }
         $patient=Role::create(['name' => 'patient']);
         $patient->givePermissionTo($PatientPermissions);


    }
}
