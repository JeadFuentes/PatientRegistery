<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('trash', 'trash')
    ->middleware(['auth', 'verified'])
    ->name('trash');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
