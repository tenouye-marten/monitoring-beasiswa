<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Laporan\LaporanController;

Route::middleware([
    'auth',
    'role:admin|keuangan|kepala'
])
->prefix('laporan')
->name('laporan.')
->group(function () {

    Route::get('/', [
        LaporanController::class,
        'index'
    ])->name('index');

    Route::get('/pdf', [
        LaporanController::class,
        'pdf'
    ])->name('pdf');

    Route::get('/excel', [
        LaporanController::class,
        'excel'
    ])->name('excel');

    

});