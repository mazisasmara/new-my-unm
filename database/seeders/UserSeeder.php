<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $ft = Group::where('slug', 'fakultas-teknik')->first();
        $fe = Group::where('slug', 'fakultas-ekonomi')->first();

        User::updateOrCreate(
            ['email' => 'superadmin@unm.test'],
            [
                'username' => 'ict',
                'password' => Hash::make('ictunm123'),
                'role' => 'superadmin',
                'status' => true,
                'group_id' => null,
            ]
        );

        User::updateOrCreate(
            ['email' => 'ft@unm.test'],
            [
                'username' => 'admin_ft',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => true,
                'group_id' => $ft->id,
            ]
        );

        User::updateOrCreate(
            ['email' => 'fe@unm.test'],
            [
                'username' => 'admin_fe',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => true,
                'group_id' => $fe->id,
            ]
        );
    }
}