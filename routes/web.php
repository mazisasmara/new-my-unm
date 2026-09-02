<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ProdiLinkController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Models\Dokumen;
use App\Models\Group;
use App\Models\Kategori;
use App\Models\Layanan;
use App\Models\Sop;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LayananController::class, 'kategori'])->name('home');

Route::get('/visit/{layanan}', [LayananController::class, 'visit'])->name(
    'layanan.visit'
);
Route::get('/layanan/{layanan}', [LayananController::class, 'show'])->name(
    'layanan.show'
);
Route::get('/prodi-link/{prodiLink}', [ProdiLinkController::class, 'visit'])
    ->name('prodi-link.visit');
/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');

    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
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
        Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name(
            'dashboard'
        );

        Route::get('/layanan', [AdminController::class, 'index'])->name(
            'layanan.index'
        );

        Route::get('/layanan/create', [AdminController::class, 'create'])->name(
            'layanan.create'
        );

        Route::post('/layanan', [AdminController::class, 'store'])->name(
            'layanan.store'
        );

        Route::get('/layanan/{layanan}/edit', [
            AdminController::class,
            'edit',
        ])->name('layanan.edit');

        Route::put('/layanan/{layanan}', [AdminController::class, 'update'])->name(
            'layanan.update'
        );

        Route::delete('/layanan/{layanan}', [
            AdminController::class,
            'destroy',
        ])->name('layanan.destroy');

        Route::patch('/layanan/{layanan}/toggle', [
            AdminController::class,
            'toggleStatus',
        ])->name('layanan.toggle');

        Route::post('/layanan/reorder', [AdminController::class, 'reorder'])->name(
            'layanan.reorder'
        );

        Route::resource('prodi', ProdiController::class)->except(['show']);
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
        Route::get('/dashboard', [DashboardController::class, 'index'])->name(
            'dashboard'
        );

        Route::get('/admins', [SuperAdminController::class, 'index'])->name(
            'admins.index'
        );

        Route::get('/admins/create', [SuperAdminController::class, 'create'])->name(
            'admins.create'
        );

        Route::post('/admins', [SuperAdminController::class, 'store'])->name(
            'admins.store'
        );

        Route::delete('/admins/{user}', [
            SuperAdminController::class,
            'destroy',
        ])->name('admins.destroy');

        Route::get('/groups/order', [
            SuperAdminController::class,
            'groupOrder',
        ])->name('groups.order');

        Route::post('/groups/reorder', [
            SuperAdminController::class,
            'reorderGroups',
        ])->name('groups.reorder');
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
        'kategoris' => Kategori::with('groups')->get(),
        'groups' => Group::with(['kategori', 'user'])->get(),
        'users' => User::with('group')->get(),
        'layanans' => Layanan::with('group')->get(),
        'dokumens' => Dokumen::all(),
        'sops' => Sop::all(),
    ];
})->middleware(['auth', 'role:superadmin']);

Route::get('/session-test', function () {
    session(['hello' => 'world']);

    return [
        'session_id' => session()->getId(),
        'hello' => session('hello'),
        'secure' => request()->secure(),
    ];
})->middleware(['auth', 'role:superadmin']);

Route::get('/headers-test', function () {
    return request()->headers->all();
})->middleware(['auth', 'role:superadmin']);

Route::get('/cookie-test', function () {
    return response('ok');
})->middleware(['auth', 'role:superadmin']);

// Slug
Route::get('/{slug}', [LayananController::class, 'kategori']);
