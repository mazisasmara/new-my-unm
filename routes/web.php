<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\AdminController;

Route::middleware(['auth', 'role:admin,superadmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
    Route::get('/layanan/{layanan}/edit', [LayananController::class, 'edit'])->name('layanan.edit');
    Route::put('/layanan/{layanan}', [LayananController::class, 'update'])->name('layanan.update');
    Route::patch('/layanan/{layanan}/toggle', [LayananController::class, 'toggleStatus'])->name('layanan.toggle');
    Route::post('/layanan/reorder', [LayananController::class, 'reorder'])->name('layanan.reorder');
});

Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');
    Route::delete('/admins/{user}', [AdminController::class, 'destroy'])->name('admins.destroy');
});

// Login
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

});

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