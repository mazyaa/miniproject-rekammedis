<?php

namespace App\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
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
        View::composer('*', function ($view) {

            $titles = [
                'dashboard' => 'Dashboard',
                'kelola-desa' => 'Data Desa',
                'kelola-jenis-kelamin' => 'Data Jenis Kelamin',
                'kelola-pasien' => 'Kelola Pasien',
                'kelola-petugas' => 'Kelola Petugas',
                'kelola-rekamedis' => 'Kelola Rekam Medis',
            ];

            // Ambil URL segment pertama
            $segment = Request::segment(1);

            $title = $titles[$segment] ?? 'Sistem Informasi';

            $view->with('title', $title);
        });
    }
}
