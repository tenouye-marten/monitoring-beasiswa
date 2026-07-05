<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboard;
use App\Http\Controllers\Keuangan\DashboardController as KeuanganDashboard;
use App\Http\Controllers\KepalaDinas\DashboardController as KepalaDashboard;
use App\Http\Controllers\Admin\JenisBeasiswaController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::middleware(['auth'])->get('/dashboard', function () {

    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    if (auth()->user()->hasRole('mahasiswa')) {
        return redirect()->route('mahasiswa.dashboard');
    }

    if (auth()->user()->hasRole('keuangan')) {
        return redirect()->route('keuangan.dashboard');
    }

    if (auth()->user()->hasRole('kepala')) {
        return redirect()->route('kepala.dashboard');
    }

    abort(403);

})->name('dashboard');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/mahasiswa.php';
require __DIR__.'/keuangan.php';
require __DIR__.'/kepala.php';
require __DIR__.'/monitoring.php';

require __DIR__.'/laporan.php';
