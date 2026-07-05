<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Monitoring\PenggunaanBeasiswaController;

Route::middleware([
    'auth',
    'role:admin|keuangan',
])
->prefix('monitoring')
->name('monitoring.')
->group(function () {

    Route::get(
        '/penggunaan-beasiswa',
        [PenggunaanBeasiswaController::class, 'index']
    )->name('penggunaan-beasiswa.index');

    Route::get(
        '/penggunaan-beasiswa/{penggunaanBeasiswa}',
        [PenggunaanBeasiswaController::class, 'show']
    )->name('penggunaan-beasiswa.show');

    Route::get(
        '/penggunaan-beasiswa/{penggunaanBeasiswa}/edit',
        [PenggunaanBeasiswaController::class, 'edit']
    )->name('penggunaan-beasiswa.edit');

    Route::put(
        '/penggunaan-beasiswa/{penggunaanBeasiswa}',
        [PenggunaanBeasiswaController::class, 'update']
    )->name('penggunaan-beasiswa.update');

});