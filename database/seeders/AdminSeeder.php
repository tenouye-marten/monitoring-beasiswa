<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MahasiswaController;

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Import Data Mahasiswa
        |--------------------------------------------------------------------------
        */

        Route::get('/mahasiswa/import', [MahasiswaController::class, 'import'])
            ->name('mahasiswa.import');

        Route::post('/mahasiswa/import', [MahasiswaController::class, 'storeImport'])
            ->name('mahasiswa.storeImport');

        /*
        |--------------------------------------------------------------------------
        | Data Mahasiswa
        |--------------------------------------------------------------------------
        */

        Route::resource('mahasiswa', MahasiswaController::class)
            ->except(['create', 'store']);
    });