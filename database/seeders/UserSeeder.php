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
            'portal-prodi-teknik' => ['admin_portal_ft', 'portal.ft@unm.test'],
            'portal-prodi-ekonomi' => ['admin_portal_fe', 'portal.fe@unm.test'],
            'portal-prodi-mipa' => ['admin_portal_fmipa', 'portal.fmipa@unm.test'],
            'portal-prodi-fip' => ['admin_portal_fip', 'portal.fip@unm.test'],
            'portal-prodi-bahasa' => ['admin_portal_fbs', 'portal.fbs@unm.test'],
            'portal-prodi-sosial' => ['admin_portal_fis', 'portal.fis@unm.test'],
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
