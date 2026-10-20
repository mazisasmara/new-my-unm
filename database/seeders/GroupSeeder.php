<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            ['universitas', 'Universitas Negeri Makassar', 'universitas-negeri-makassar'],
            ['fakultas', 'Fakultas UNM', 'fakultas-unm'],
            ['mahasiswa', 'Kemahasiswaan', 'kemahasiswaan'],
            ['perpustakaan', 'Perpustakaan UNM', 'perpustakaan-unm'],
            ['portal-prodi', 'Program Pasca Sarjana', 'portal-prodi-pascasarjana'],
            ['portal-prodi', 'Matematika dan Ilmu Pengetahuan Alam', 'portal-prodi-mipa'],
            ['portal-prodi', 'Fakultas Teknik', 'portal-prodi-teknik'],
            ['portal-prodi', 'Fakultas Ilmu Keolahragaan', 'portal-prodi-fik'],
            ['portal-prodi', 'Fakultas Ilmu Pendidikan', 'portal-prodi-fip'],
            ['portal-prodi', 'Fakultas Bahasa dan Sastra', 'portal-prodi-fbs'],
            ['portal-prodi', 'Fakultas Ilmu Sosial', 'portal-prodi-fis'],
            ['portal-prodi', 'Fakultas Psikologi', 'portal-prodi-psikologi'],
            ['portal-prodi', 'Fakultas Seni dan Desain', 'portal-prodi-fsd'],
            ['portal-prodi', 'Fakultas Ekonomi', 'portal-prodi-ekonomi'],
            ['portal-prodi', 'Fakultas Kedokteran', 'portal-prodi-kedokteran'],
        ];

        Group::query()->delete();

        $orders = [];
        foreach ($groups as [$categorySlug, $name, $slug]) {
            $category = Kategori::where('slug', $categorySlug)->firstOrFail();
            $orders[$categorySlug] = ($orders[$categorySlug] ?? 0) + 1;

            Group::create([
                'kategori_id' => $category->id,
                'nama_group' => $name,
                'slug' => $slug,
                'urutan' => $orders[$categorySlug],
                'status' => true,
            ]);
        }
    }
}
