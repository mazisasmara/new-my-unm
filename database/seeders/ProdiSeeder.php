<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Prodi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            'portal-prodi-teknik' => ['Teknik Informatika', 'Teknik Elektro', 'Teknik Sipil', 'Pendidikan Teknik Mesin', 'Pendidikan Teknik Otomotif'],
            'portal-prodi-ekonomi' => ['Manajemen', 'Akuntansi', 'Ekonomi Pembangunan', 'Pendidikan Ekonomi', 'Bisnis Digital'],
            'portal-prodi-mipa' => ['Matematika', 'Fisika', 'Kimia', 'Biologi', 'Statistika'],
            'portal-prodi-fip' => ['Bimbingan dan Konseling', 'Teknologi Pendidikan', 'Pendidikan Guru Sekolah Dasar', 'Pendidikan Guru PAUD', 'Administrasi Pendidikan'],
            'portal-prodi-bahasa' => ['Pendidikan Bahasa Indonesia', 'Pendidikan Bahasa Inggris', 'Sastra Indonesia', 'Sastra Inggris', 'Pendidikan Bahasa Jerman'],
            'portal-prodi-sosial' => ['Pendidikan Sejarah', 'Pendidikan Geografi', 'Pendidikan Sosiologi', 'Ilmu Administrasi Negara', 'Pendidikan Pancasila dan Kewarganegaraan'],
        ];

        Prodi::whereHas('group.kategori', fn ($query) => $query->where('slug', 'portal-prodi'))->delete();

        foreach ($programs as $groupSlug => $titles) {
            $group = Group::where('slug', $groupSlug)->firstOrFail();
            $owner = $group->user()->where('role', 'admin')->firstOrFail();

            foreach ($titles as $index => $title) {
                $prodi = Prodi::create([
                    'group_id' => $group->id,
                    'created_by' => $owner->id,
                    'judul' => $title,
                    'status' => true,
                    'urutan' => $index + 1,
                ]);

                $slug = Str::slug($title);
                $prodi->links()->createMany([
                    ['label' => 'Website '.$title, 'url' => 'https://unm.ac.id/prodi/'.$slug, 'urutan' => 1],
                    ['label' => 'Informasi Akademik '.$title, 'url' => 'https://unm.ac.id/akademik/'.$slug, 'urutan' => 2],
                ]);
            }
        }
    }
}
