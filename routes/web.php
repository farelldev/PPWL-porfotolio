<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectGalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProjectController::class, 'home'])->name('home');
Route::get('/about', fn() => view('about'))->name('about'); 
Route::get('/experience', [PageController::class, 'experience'])->name('experience');
Route::get('/education', [PageController::class, 'education'])->name('education');
Route::get('/projects', [ProjectController::class, 'publicIndex'])->name('projects.public.index');
Route::get('/projects/{slug}', [ProjectController::class, 'publicShow'])->name('projects.public.show');
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:contact')
    ->name('contact.store');

Route::prefix('post')->middleware('auth')->group(function () {
    // Route projects yang sudah ada
    Route::get('/projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
    Route::post('/projects/{id}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
    Route::delete('/projects/{id}/force-delete', [ProjectController::class, 'forceDelete'])->name('projects.force-delete');
    Route::resource('projects', ProjectController::class);
    Route::get('/contacts', [ContactAdminController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [ContactAdminController::class, 'show'])->name('contacts.show');

    Route::get('/profile-saya', function () {
        return view('profile.saya');
    })->name('profile.saya');
    Route::post('/profile-saya/foto', [ProfileController::class, 'updatePhoto'])->name('profile.saya.photo.update');
    
    // Route profile bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('dashboard/clear-cache', [DashboardController::class, 'clearCache'])->name('dashboard.clear-cache');
    
    Route::post('projects/{project}/gallery', [ProjectGalleryController::class, 'store'])->name('projects.gallery.store');
    Route::put('projects/{project}/gallery/{image}', [ProjectGalleryController::class, 'update'])->name('projects.gallery.update');
    Route::delete('projects/{project}/gallery/{image}', [ProjectGalleryController::class, 'destroy'])->name('projects.gallery.destroy');
});

require __DIR__.'/auth.php';