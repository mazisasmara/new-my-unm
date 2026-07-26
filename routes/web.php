<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LayananController::class, 'index'] );

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

// debug database
Route::get('/debug', function () {
    return [
        'fakultas' => \App\Models\Fakultas::all(),
        'prodis' => \App\Models\Prodi::all(),
        'users' => \App\Models\User::all(),
        'kategoris' => \App\Models\Kategori::all(),
        'layanans' => \App\Models\Layanan::all(),
        'dokumens' => \App\Models\Dokumen::all(),
        'sops' => \App\Models\Sop::all(),
    ];
});