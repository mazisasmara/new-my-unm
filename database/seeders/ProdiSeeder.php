<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        $group = Group::with('user')->where('slug', 'portal-program-studi')->firstOrFail();
        $prodi = Prodi::updateOrCreate(
            ['group_id' => $group->id, 'judul' => 'Portal Program Studi UNM'],
            ['created_by' => $group->user->id, 'status' => true, 'urutan' => 1]
        );

        foreach ([
            ['Daftar Program Studi', 'https://unm.ac.id/prodi'],
            ['Penerimaan Mahasiswa Baru', 'https://pmb.unm.ac.id'],
        ] as $index => [$label, $url]) {
            $prodi->links()->updateOrCreate(
                ['label' => $label],
                ['url' => $url, 'urutan' => $index + 1]
            );
        }
    }
}
