<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\SuperAdmin\AdminController;
use App\Http\Controllers\SuperAdmin\DashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() =>
    app(LayananController::class)->kategori('universitas')
)->name('home');

Route::get('/{slug}', [LayananController::class, 'kategori']);

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'create'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');
});


/*
|--------------------------------------------------------------------------
| Admin & Superadmin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,superadmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/layanan', [LayananController::class, 'adminIndex'])
            ->name('layanan.index');

        Route::get('/layanan/create', [LayananController::class, 'create'])
            ->name('layanan.create');

        Route::post('/layanan', [LayananController::class, 'store'])
            ->name('layanan.store');

        Route::get('/layanan/{layanan}/edit', [LayananController::class, 'edit'])
            ->name('layanan.edit');

        Route::put('/layanan/{layanan}', [LayananController::class, 'update'])
            ->name('layanan.update');

        Route::delete('/layanan/{layanan}', [LayananController::class, 'destroy'])
            ->name('layanan.destroy');

        Route::patch('/layanan/{layanan}/toggle', [LayananController::class, 'toggleStatus'])
            ->name('layanan.toggle');

        Route::post('/layanan/reorder', [LayananController::class, 'reorder'])
            ->name('layanan.reorder');
    });


/*
|--------------------------------------------------------------------------
| Superadmin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:superadmin'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/admins', [AdminController::class, 'index'])
            ->name('admins.index');

        Route::get('/admins/create', [AdminController::class, 'create'])
            ->name('admins.create');

        Route::post('/admins', [AdminController::class, 'store'])
            ->name('admins.store');

        Route::delete('/admins/{user}', [AdminController::class, 'destroy'])
            ->name('admins.destroy');
    });


/*
|--------------------------------------------------------------------------
| Debug Routes
|--------------------------------------------------------------------------
| Hapus sebelum production
|--------------------------------------------------------------------------
*/

Route::get('/debug', function () {
    return [
        'kategoris' => \App\Models\Kategori::with('groups')->get(),
        'groups' => \App\Models\Group::with(['kategori', 'user'])->get(),
        'users' => \App\Models\User::with('group')->get(),
        'layanans' => \App\Models\Layanan::with('group')->get(),
        'dokumens' => \App\Models\Dokumen::all(),
        'sops' => \App\Models\Sop::all(),
    ];
});

Route::get('/test-session', function () {

    session(['nama' => 'Azis']);

    return [
        'session_id' => session()->getId(),
        'nama' => session('nama'),
    ];
});

Route::get('/cookie-test', function () {
    return response('ok');
});