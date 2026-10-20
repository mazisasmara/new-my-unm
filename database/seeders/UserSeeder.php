<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->delete();

        User::create([
            'username' => 'ict',
            'email' => 'superadmin@unm.test',
            'password' => 'ictunm123',
            'role' => 'superadmin',
            'status' => true,
            'group_id' => null,
        ]);

        foreach (Group::orderBy('id')->get() as $group) {
            User::create([
                'username' => 'admin_'.Str::slug($group->slug, '_'),
                'email' => $group->slug.'@unm.test',
                'password' => 'password',
                'role' => 'admin',
                'status' => true,
                'group_id' => $group->id,
            ]);
        }
    }
}
