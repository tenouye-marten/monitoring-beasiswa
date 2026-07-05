<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Keuangan\PenggunaanBeasiswaController;

Route::middleware(['auth','role:keuangan'])
    ->prefix('keuangan')
    ->name('keuangan.')
    ->group(function () {

          Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

        Route::get(
            'penggunaan-beasiswa',
            [PenggunaanBeasiswaController::class,'index']
        )->name('penggunaan-beasiswa.index');

        Route::get(
            'penggunaan-beasiswa/{penggunaanBeasiswa}',
            [PenggunaanBeasiswaController::class,'show']
        )->name('penggunaan-beasiswa.show');

        Route::get(
            'penggunaan-beasiswa/{penggunaanBeasiswa}/verifikasi',
            [PenggunaanBeasiswaController::class,'verifikasi']
        )->name('penggunaan-beasiswa.verifikasi');

        Route::put(
            'penggunaan-beasiswa/{penggunaanBeasiswa}/verifikasi',
            [PenggunaanBeasiswaController::class,'updateVerifikasi']
        )->name('penggunaan-beasiswa.updateVerifikasi');

    });