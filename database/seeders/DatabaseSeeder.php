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
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Superadmin
        User::firstOrCreate(
            ['username' => 'ict'],
            [
                'email' => 'muhammadAzis070409@gmail.com',
                'password' => Hash::make('ictunm123'),
                'role' => 'superadmin',
                'fakultas_id' => null,
                'unit_id' => null,
                'status' => true,
            ]
          );
          
        // Admin
        User::firstOrCreate(
            ['username' => 'ftlab'],
            [
                'email' => 'dummylab@gmail.com',
                'password' => Hash::make('ftlab'),
                'role' => 'admin',
                'fakultas_id' => null,
                'unit_id' => null,
                'status' => true,
            ]
        );
        // Admin
        User::firstOrCreate(
            ['username' => 'ftperpustakaan'],
            [
                'email' => 'dummyperpus@gmail.com',
                'password' => Hash::make('ftlab'),
                'role' => 'admin',
                'fakultas_id' => null,
                'unit_id' => null,
                'status' => true,
            ]
        );

        // Fakultas
        $ft = Fakultas::firstOrCreate(['nama_fakultas' => 'Fakultas Teknik - lab']);
        $ftp = Fakultas::firstOrCreate(['nama_fakultas' => 'Fakultas Teknik - perpustakaan']);

        // Unit
        $unitFt = Unit::firstOrCreate(['fakultas_id' => $ft->id, 'nama_unit' => 'UPT Fakultas Teknik - lab']);
        Unit::firstOrCreate(['fakultas_id' => $ftp->id, 'nama_unit' => 'UPT Fakultas Teknik - Perpustakaan']);

        // Kategori
        Kategori::firstOrCreate(['nama_kategori' => 'Universitas'], ['urutan' => 1]);
        $kFakultas = Kategori::firstOrCreate(['nama_kategori' => 'Fakultas'], ['urutan' => 2]);
        Kategori::firstOrCreate(['nama_kategori' => 'Portal Prodi'], ['urutan' => 3]);
        Kategori::firstOrCreate(['nama_kategori' => 'Mahasiswa'], ['urutan' => 4]);
        Kategori::firstOrCreate(['nama_kategori' => 'Perpustakaan'], ['urutan' => 5]);
        Kategori::firstOrCreate(['nama_kategori' => 'Dokumen'], ['urutan' => 6]);

        $admin = User::where('role', 'admin')->first();

        // Layanan
        $layanan1 = Layanan::firstOrCreate(
            ['nama_layanan' => 'FT-Laboratorium'],
            [
                'users_id' => $admin->id,
                'kategori_id' => $kFakultas->id,
                'unit_id' => $unitFt->id,
                'deskripsi' => 'Layanan laboratorium mahasiswa Fakultas Teknik',
                'link' => 'https://ft.unm.ac.id/lab',
                'status' => true,
                'urutan' => 1,
            ]
        );

        Layanan::firstOrCreate(
            ['nama_layanan' => 'FT-Library'],
            [
                'users_id' => $admin->id,
                'kategori_id' => $kFakultas->id,
                'unit_id' => $unitFt->id,
                'deskripsi' => 'Perpustakaan fakultas Teknik',
                'link' => 'https://ft.unm.ac.id/library',
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