<?php

use App\Livewire\Student\RequirementList;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

/**
 * Default post-login redirect route.
 * Redirects the user to their role-specific dashboard based on their role.
 * Aborts with 403 if the role is unknown or unhandled.
 */
Route::middleware(['auth', 'approved'])->get('/dashboard', function () {
    return match(auth()->user()->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'student' => redirect()->route('student.dashboard'),
        default   => abort(403),
    };
})->name('dashboard');

// Student Related Routes
Route::middleware(['auth', 'approved', 'student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        Route::view('/dashboard', 'student.dashboard')->name('dashboard');
        Route::get('/requirements', RequirementList::class);
    });

// Admin Related Routes
Route::middleware(['auth', 'approved', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    });



require __DIR__.'/settings.php';
