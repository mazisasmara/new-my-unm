<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Layanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        // Portal Prodi menggunakan struktur judul + banyak tautan, bukan layanan biasa.
        Layanan::whereHas('group.kategori', fn ($query) => $query->where('slug', 'portal-prodi'))->delete();

        $services = [
            'universitas-negeri-makassar' => [
                ['Website Resmi UNM', 'Portal resmi Universitas Negeri Makassar', 'https://unm.ac.id'],
                ['SIA UNM', 'Sistem Informasi Akademik UNM', 'https://sia.unm.ac.id'],
                ['PMB UNM', 'Portal Penerimaan Mahasiswa Baru', 'https://pmb.unm.ac.id'],
            ],
            'fakultas-teknik' => [
                ['Website Fakultas Teknik', 'Website resmi Fakultas Teknik', 'https://ft.unm.ac.id'],
                ['Laboratorium FT', 'Portal informasi laboratorium Fakultas Teknik', 'https://lab.ft.unm.ac.id'],
            ],
            'fakultas-ekonomi' => [
                ['Website Fakultas Ekonomi', 'Website resmi Fakultas Ekonomi', 'https://fe.unm.ac.id'],
            ],
            'fakultas-mipa' => [
                ['Website Fakultas MIPA', 'Website resmi Fakultas MIPA', 'https://fmipa.unm.ac.id'],
            ],
            'kemahasiswaan' => [
                ['Kemahasiswaan UNM', 'Portal kegiatan mahasiswa', 'https://kemahasiswaan.unm.ac.id'],
            ],
            'perpustakaan-unm' => [
                ['Perpustakaan Digital', 'Layanan perpustakaan digital UNM', 'https://library.unm.ac.id'],
            ],
        ];

        foreach ($services as $groupSlug => $items) {
            $group = Group::with('user')->where('slug', $groupSlug)->firstOrFail();

            foreach ($items as $index => [$name, $description, $url]) {
                Layanan::updateOrCreate(
                    ['group_id' => $group->id, 'nama_layanan' => $name],
                    [
                        'created_by' => $group->user->id,
                        'logo' => null,
                        'deskripsi' => $description,
                        'link' => $url,
                        'status' => true,
                        'urutan' => $index + 1,
                    ]
                );
            }
        }
    }
}
