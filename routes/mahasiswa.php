<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\PenggunaanBeasiswaController;

Route::middleware([
    'auth',
    'role:mahasiswa'
])
->prefix('mahasiswa')
->name('mahasiswa.')
->group(function () {

    Route::get(
        '/dashboard',
        [DashboardController::class,'index']
    )->name('dashboard');


    Route::resource(
    'penggunaan-beasiswa',
    PenggunaanBeasiswaController::class
);

});