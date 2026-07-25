<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('universitas', ['title' => 'Universitas']);
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
