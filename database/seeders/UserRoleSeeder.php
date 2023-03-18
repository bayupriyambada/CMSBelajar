<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = "password";
        \App\Models\User::create([
            'name' => 'Operator',
            'email' => 'operator@cms.com',
            'password' => Hash::make($password),
            'roles' => 'operator'
        ]);
        \App\Models\User::create([
            'name' => 'teacher',
            'email' => 'teacher@cms.com',
            'password' => Hash::make($password),
            'roles' => 'teacher'
        ]);
        \App\Models\User::create([
            'name' => 'student',
            'email' => 'student@cms.com',
            'password' => Hash::make($password),
            'roles' => 'students'
        ]);
    }
}
