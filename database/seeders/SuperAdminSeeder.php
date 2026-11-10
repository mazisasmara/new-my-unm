<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->firstOrCreate(
            ['username' => config('superadmin.username')],
            [
                'email' => config('superadmin.email'),
                'password' => Hash::make(config('superadmin.password')),
                'role' => 'superadmin',
                'status' => true,
                'group_id' => null,
            ],
        );
    }
}
