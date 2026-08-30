<?php

namespace App\Providers;

use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('kategoris', Schema::hasTable('kategoris')
            ? Kategori::orderBy('urutan')->get()
            : collect());
        Carbon::setLocale('id');
    }
}
