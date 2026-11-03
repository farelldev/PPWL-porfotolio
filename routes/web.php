<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('home'))->name('home');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/education', fn() => view('education'))->name('education');

Route::prefix('post')->middleware('auth')->group(function () {
    // Route projects yang sudah ada
    Route::get('/projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
    Route::post('/projects/{id}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
    Route::delete('/projects/{id}/force-delete', [ProjectController::class, 'forceDelete'])->name('projects.force-delete');
    Route::resource('projects', ProjectController::class);

    Route::get('/profile-saya', function () {
        return view('profile.saya');
    })->name('profile.saya');
    
    // Route profile bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';