<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

// Halaman Utama (Welcome)
Route::get('/', function () {
    return view('welcome');
});

// Semua rute di dalam grup ini wajib Login (Middleware Auth)
Route::middleware('auth')->group(function () {

    // Rute Custom Kita (Dashboard, Schedules, Notes)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('schedules', ScheduleController::class);
    Route::resource('notes', NoteController::class);

    // Rute Profil (Bawaan Laravel Breeze - INI YANG MEMPERBAIKI ERROR)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Memanggil rute login/register bawaan
require __DIR__ . '/auth.php';
