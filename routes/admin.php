<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriPenggunaanController;
use App\Http\Controllers\Admin\MahasiswaController;

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');


            Route::get(
    'mahasiswa/template/download',
    [MahasiswaController::class,'downloadTemplate']
)->name('mahasiswa.template');

Route::get(
    'mahasiswa/import/log',
    [MahasiswaController::class,'riwayatImport']
)->name('mahasiswa.import.log');

        // Import Mahasiswa
        Route::get('/mahasiswa/import', [MahasiswaController::class, 'import'])
            ->name('mahasiswa.import');

        Route::post('/mahasiswa/import', [MahasiswaController::class, 'storeImport'])
            ->name('mahasiswa.storeImport');

        // Data Mahasiswa
        Route::resource('mahasiswa', MahasiswaController::class)
            ->except(['create', 'store']);



            
Route::resource(
    'kategori-penggunaan',
    KategoriPenggunaanController::class
);

    });