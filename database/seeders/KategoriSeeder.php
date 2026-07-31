<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_kategori' => 'Universitas', 'slug' => 'universitas', 'urutan' => 1],
            ['nama_kategori' => 'Fakultas', 'slug' => 'fakultas', 'urutan' => 2],
            ['nama_kategori' => 'Mahasiswa', 'slug' => 'mahasiswa', 'urutan' => 3],
            ['nama_kategori' => 'Perpustakaan', 'slug' => 'perpustakaan', 'urutan' => 4],
            ['nama_kategori' => 'Portal Prodi', 'slug' => 'portal-prodi', 'urutan' => 5],
        ];

        foreach ($data as $item) {
            Kategori::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }
    }
}