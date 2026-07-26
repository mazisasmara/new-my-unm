<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('universitas', [
      'title' => 'Universitas',
      'layanan' => [
        [
          'logoPath' => 'logo/gambar.png',
          'namaLayanan' => 'ICT',
          'deskripsi' => 'Lorem Ipsum ini adalah deskripsi ICT',
          'link' => 'https://azisasmara.my.id'
        ],
        [
          'logoPath' => 'logo/gambar.png',
          'namaLayanan' => 'Media UNM',
          'deskripsi' => 'Lorem Ipsum ini adalah deskripsi Media UNM',
          'link' => 'https://azisasmara.my.id'
        ],
        [
          'logoPath' => 'logo/gambar.png',
          'namaLayanan' => 'Lab Kom',
          'deskripsi' => 'Lorem Ipsum ini adalah deskripsi Lab Kom',
          'link' => 'https://azisasmara.my.id'
        ],
        [
          'logoPath' => 'logo/gambar.png',
          'namaLayanan' => 'Perpustakaan',
          'deskripsi' => 'Lorem Ipsum ini adalah deskripsi Perpustakaan',
          'link' => 'https://azisasmara.my.id'
        ],
        [
          'logoPath' => 'logo/gambar.png',
          'namaLayanan' => 'UNM Phinisi',
          'deskripsi' => 'Lorem Ipsum ini adalah deskripsi UNM Phinisi',
          'link' => 'https://azisasmara.my.id'
        ],
      ]
    ]);
});

Route::get('/fakultas', function () {
    return view('fakultas', ['title' => 'Fakultas']);
});

Route::get('/portal-prodi', function () {
    return view('portalprodi', ['title' => 'Portal Prodi']);
});

Route::get('/mahasiswa', function () {
    return view('mahasiswa', ['title' => 'Mahasiswa']);
});

Route::get('/perpustakaan', function () {
    return view('perpustakaan', ['title' => 'Perpustakaan']);
});

Route::get('/dokumen', function () {
    return view('dokumen', ['title' => 'Dokumen']);
});
