<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Layanan;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'group_id' => 1,
                'created_by' => 1,
                'nama_layanan' => 'Website Resmi UNM',
                'logo' => null,
                'deskripsi' => 'Portal resmi Universitas Negeri Makassar',
                'link' => 'https://unm.ac.id',
                'status' => true,
                'urutan' => 1,
            ],

            [
                'group_id' => 1,
                'created_by' => 1,
                'nama_layanan' => 'SIA UNM',
                'logo' => null,
                'deskripsi' => 'Sistem Informasi Akademik UNM',
                'link' => 'https://sia.unm.ac.id',
                'status' => true,
                'urutan' => 2,
            ],

            [
                'group_id' => 1,
                'created_by' => 1,
                'nama_layanan' => 'PMB UNM',
                'logo' => null,
                'deskripsi' => 'Portal Penerimaan Mahasiswa Baru',
                'link' => 'https://pmb.unm.ac.id',
                'status' => true,
                'urutan' => 3,
            ],

            [
                'group_id' => 2,
                'created_by' => 2,
                'nama_layanan' => 'Website Fakultas Teknik',
                'logo' => null,
                'deskripsi' => 'Website resmi Fakultas Teknik',
                'link' => 'https://ft.unm.ac.id',
                'status' => true,
                'urutan' => 1,
            ],

            [
                'group_id' => 2,
                'created_by' => 2,
                'nama_layanan' => 'Laboratorium FT',
                'logo' => null,
                'deskripsi' => 'Portal informasi laboratorium Fakultas Teknik',
                'link' => 'https://lab.ft.unm.ac.id',
                'status' => true,
                'urutan' => 2,
            ],

            [
                'group_id' => 3,
                'created_by' => 1,
                'nama_layanan' => 'Website Fakultas Ekonomi',
                'logo' => null,
                'deskripsi' => 'Website resmi Fakultas Ekonomi',
                'link' => 'https://fe.unm.ac.id',
                'status' => true,
                'urutan' => 1,
            ],

            [
                'group_id' => 4,
                'created_by' => 1,
                'nama_layanan' => 'Website Fakultas MIPA',
                'logo' => null,
                'deskripsi' => 'Website resmi Fakultas MIPA',
                'link' => 'https://fmipa.unm.ac.id',
                'status' => true,
                'urutan' => 1,
            ],

            [
                'group_id' => 5,
                'created_by' => 1,
                'nama_layanan' => 'Kemahasiswaan UNM',
                'logo' => null,
                'deskripsi' => 'Portal kegiatan mahasiswa',
                'link' => 'https://kemahasiswaan.unm.ac.id',
                'status' => true,
                'urutan' => 1,
            ],

            [
                'group_id' => 6,
                'created_by' => 1,
                'nama_layanan' => 'Perpustakaan Digital',
                'logo' => null,
                'deskripsi' => 'Layanan perpustakaan digital UNM',
                'link' => 'https://library.unm.ac.id',
                'status' => true,
                'urutan' => 1,
            ],

            [
                'group_id' => 7,
                'created_by' => 1,
                'nama_layanan' => 'Portal Program Studi',
                'logo' => null,
                'deskripsi' => 'Daftar seluruh program studi UNM',
                'link' => 'https://prodi.unm.ac.id',
                'status' => true,
                'urutan' => 1,
            ],
        ];

        foreach ($data as $item) {
            Layanan::create($item);
        }
    }
}