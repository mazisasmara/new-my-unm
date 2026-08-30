<?php

namespace App\Providers;

use App\Models\Kategori;
use Carbon\Carbon;
use Fruitcake\LaravelDebugbar\ServiceProvider as DebugbarServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local') && class_exists(DebugbarServiceProvider::class)) {
            $this->app->register(DebugbarServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.navbar', function ($view): void {
            try {
                $kategoris = Cache::remember(
                    'navigation.kategoris',
                    now()->addMinutes(10),
                    fn () => Kategori::orderBy('urutan')->get(),
                );
            } catch (Throwable $exception) {
                try {
                    report($exception);
                } catch (Throwable) {
                    // Navigation is non-critical while the database is unavailable.
                }
                $kategoris = collect();
            }

            $view->with('kategoris', $kategoris);
        });
        Carbon::setLocale('id');
    }
}
