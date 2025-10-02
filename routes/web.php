<?php

use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::view('/', 'pages.index')->name('home');
Route::view('/about', 'pages.about')->name('about');
Route::view('/services', 'pages.services')->name('services');
Route::view('/contact', 'pages.contact')->name('contact');

// Tracking routes
Route::get('/track', [TrackingController::class, 'index'])->name('track');
Route::post('/track/search', [TrackingController::class, 'search'])->name('track.search');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
