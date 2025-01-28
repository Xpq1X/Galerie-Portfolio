<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); // Gallery - protected by auth
})->middleware('auth'); // Only authenticated users can access this route

// Login Route
Route::get('/login', function () {
    return view('auth.login'); // Custom Login Page
})->name('login');

// Dashboard Route (Optional: You can have this for users after login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes (Protected by auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php'; // Ensure this includes the authentication routes like register, login, etc.
