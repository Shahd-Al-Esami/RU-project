<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin=User::firstOrcreate([
        'name'        =>'shahd',
        'age'         =>20,
        'email'       =>'admin@gmail.com',
        'password'    =>Hash::make('11111111'),
        'country'     =>'syria',
        'role'        =>'admin',
        'gender'      =>'female',
        'phone_number'=>'0987654321',

        ]);
        $admin->assignRole('admin');
    }
}
