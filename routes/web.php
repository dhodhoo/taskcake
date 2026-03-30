<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
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

    // Timeline / Global Notes
    Route::resource('posts', PostController::class)->only(['index', 'store', 'destroy']);
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('posts/{post}/likes', [LikeController::class, 'toggle'])->name('likes.toggle');

    // Rute Profil (Bawaan Laravel Breeze - INI YANG MEMPERBAIKI ERROR)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Memanggil rute login/register bawaan
require __DIR__ . '/auth.php';
