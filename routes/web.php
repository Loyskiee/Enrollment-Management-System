<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware('auth','student', 'approved')
->prefix('student')
->name('student')
->group( function() {
    // student related routes
});

require __DIR__.'/settings.php';
