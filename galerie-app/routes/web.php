<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

// Gallery - protected by auth
Route::get('/', function () {
    return view('welcome');
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

// Admin Gallery Routes (Only accessible by Admins)
Route::middleware(['auth', 'admin'])->group(function () {
    // View Gallery (Admin can manage it)
    Route::get('/admin/gallery', [GalleryController::class, 'adminGallery'])->name('admin.gallery');

    // Add Item to Gallery
    Route::post('/admin/gallery', [GalleryController::class, 'addItem'])->name('admin.addItem');

    // Delete Item from Gallery
    Route::delete('/admin/gallery/{item}', [GalleryController::class, 'deleteItem'])->name('admin.deleteItem');
});

require __DIR__.'/auth.php'; // Ensure this includes the authentication routes like register, login, etc.
