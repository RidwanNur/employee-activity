<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AtasanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['role:admin'])->group(function () {
//     Route::get('/manage-books', [BookController::class, 'index'])->name('manage.books');
// });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth','verified')->group(function () {
    Route::middleware(['role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index','listEmployee'])->name('dashboard');
    // Route::get('/dashboard', [AdminController::class, 'listEmployee'])->name('listEmployee');
});
});


Route::middleware('auth','verified')->group(function () {
    Route::middleware(['role:pegawai'])->group(function () {
    Route::get('/dashboard/pegawai', [PegawaiController::class, 'index'])->name('pegawai.dashboard');
});
});

Route::middleware('auth','verified')->group(function () {
    Route::middleware(['role:atasan'])->group(function () {
    Route::get('/dashboard/atasan', [AtasanController::class, 'index'])->name('atasan.dashboard');
});
});


Route::middleware('auth','verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
