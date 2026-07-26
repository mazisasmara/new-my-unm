<?php

namespace Database\Seeders;

use App\Models\Dokumen;
use App\Models\Fakultas;
use App\Models\Kategori;
use App\Models\Layanan;
use App\Models\Sop;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Superadmin
        User::firstOrCreate(
            ['username' => 'ict'],
            [
                'email' => 'muhammadAzis070409@gmail.com',
                'password' => 'ictunm123',
                'role' => 'superadmin',
                'fakultas_id' => null,
                'unit_id' => null,
                'status' => true,
            ]
        );

        // Fakultas
        $ft = Fakultas::firstOrCreate(['nama_fakultas' => 'Fakultas Teknik']);
        $fip = Fakultas::firstOrCreate(['nama_fakultas' => 'Fakultas Ilmu Pendidikan']);

        // Unit
        $unitFt = Unit::firstOrCreate(['fakultas_id' => $ft->id, 'nama_unit' => 'UPT Fakultas Teknik']);
        Unit::firstOrCreate(['fakultas_id' => $fip->id, 'nama_unit' => 'UPT Fakultas Ilmu Pendidikan']);

        // Kategori
        Kategori::firstOrCreate(['nama_kategori' => 'Universitas'], ['urutan' => 1]);
        $kFakultas = Kategori::firstOrCreate(['nama_kategori' => 'Fakultas'], ['urutan' => 2]);
        Kategori::firstOrCreate(['nama_kategori' => 'Portal Prodi'], ['urutan' => 3]);
        Kategori::firstOrCreate(['nama_kategori' => 'Mahasiswa'], ['urutan' => 4]);
        Kategori::firstOrCreate(['nama_kategori' => 'Perpustakaan'], ['urutan' => 5]);
        Kategori::firstOrCreate(['nama_kategori' => 'Dokumen'], ['urutan' => 6]);

        $superadmin = User::where('role', 'superadmin')->first();

        // Layanan
        $layanan1 = Layanan::firstOrCreate(
            ['nama_layanan' => 'FT-Registrasi'],
            [
                'users_id' => $superadmin->id,
                'kategori_id' => $kFakultas->id,
                'unit_id' => $unitFt->id,
                'deskripsi' => 'Layanan registrasi mahasiswa Fakultas Teknik',
                'link' => 'https://ft.unm.ac.id/registrasi',
                'status' => true,
                'urutan' => 1,
            ]
        );

        Layanan::firstOrCreate(
            ['nama_layanan' => 'FT-Event'],
            [
                'users_id' => $superadmin->id,
                'kategori_id' => $kFakultas->id,
                'unit_id' => $unitFt->id,
                'deskripsi' => 'Informasi event Fakultas Teknik',
                'link' => 'https://ft.unm.ac.id/event',
                'status' => true,
                'urutan' => 2,
            ]
        );

        // Dokumen
        Dokumen::firstOrCreate([
            'layanan_id' => $layanan1->id,
            'file' => 'dokumen/panduan-registrasi.pdf',
        ], ['deskripsi' => 'Panduan registrasi mahasiswa baru']);

        // SOP
        Sop::firstOrCreate([
            'layanan_id' => $layanan1->id,
            'file' => 'sop/sop-registrasi.pdf',
        ], ['deskripsi' => 'SOP alur registrasi mahasiswa']);
    }
}