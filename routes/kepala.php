<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kepala\DashboardController;

Route::middleware(['auth','role:kepala'])
    ->prefix('kepala')
    ->name('kepala.')
    ->group(function () {

     
    Route::get('/dashboard', [DashboardController::class,'index'])
        ->name('dashboard');

    });