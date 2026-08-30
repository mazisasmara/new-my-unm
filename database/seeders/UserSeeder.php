<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superadmin@unm.test'],
            ['username' => 'ict', 'password' => 'ictunm123', 'role' => 'superadmin', 'status' => true, 'group_id' => null]
        );

        $admins = [
            'universitas-negeri-makassar' => ['admin_universitas', 'universitas@unm.test'],
            'fakultas-teknik' => ['admin_ft', 'ft@unm.test'],
            'fakultas-ekonomi' => ['admin_fe', 'fe@unm.test'],
            'fakultas-mipa' => ['admin_fmipa', 'fmipa@unm.test'],
            'kemahasiswaan' => ['admin_mahasiswa', 'mahasiswa@unm.test'],
            'perpustakaan-unm' => ['admin_perpustakaan', 'perpustakaan@unm.test'],
            'portal-program-studi' => ['admin_prodi', 'prodi@unm.test'],
        ];

        foreach ($admins as $groupSlug => [$username, $email]) {
            $group = Group::where('slug', $groupSlug)->firstOrFail();

            User::updateOrCreate(
                ['email' => $email],
                [
                    'username' => $username,
                    'password' => 'password',
                    'role' => 'admin',
                    'status' => true,
                    'group_id' => $group->id,
                ]
            );
        }
    }
}
