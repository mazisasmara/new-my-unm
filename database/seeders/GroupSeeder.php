<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $universitas = Kategori::where('slug', 'universitas')->first();
        $fakultas = Kategori::where('slug', 'fakultas')->first();
        $mahasiswa = Kategori::where('slug', 'mahasiswa')->first();
        $perpustakaan = Kategori::where('slug', 'perpustakaan')->first();
        $portalProdi = Kategori::where('slug', 'portal-prodi')->first();

        $groups = [
            [
                'kategori_id' => $universitas->id,
                'nama_group' => 'Universitas Negeri Makassar',
                'slug' => 'universitas-negeri-makassar',
                'urutan' => 1,
            ],

            [
                'kategori_id' => $fakultas->id,
                'nama_group' => 'Fakultas Teknik',
                'slug' => 'fakultas-teknik',
                'urutan' => 1,
            ],

            [
                'kategori_id' => $fakultas->id,
                'nama_group' => 'Fakultas Ekonomi',
                'slug' => 'fakultas-ekonomi',
                'urutan' => 2,
            ],

            [
                'kategori_id' => $fakultas->id,
                'nama_group' => 'Fakultas MIPA',
                'slug' => 'fakultas-mipa',
                'urutan' => 3,
            ],

            [
                'kategori_id' => $mahasiswa->id,
                'nama_group' => 'Kemahasiswaan',
                'slug' => 'kemahasiswaan',
                'urutan' => 1,
            ],

            [
                'kategori_id' => $perpustakaan->id,
                'nama_group' => 'Perpustakaan UNM',
                'slug' => 'perpustakaan-unm',
                'urutan' => 1,
            ],

            [
                'kategori_id' => $portalProdi->id,
                'nama_group' => 'Portal Program Studi',
                'slug' => 'portal-program-studi',
                'urutan' => 1,
            ],
        ];

        foreach ($groups as $group) {
            Group::updateOrCreate(
                ['slug' => $group['slug']],
                array_merge($group, ['status' => true])
            );
        }
    }
}