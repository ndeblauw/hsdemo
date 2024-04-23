<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// PUBLIC routes
Route::get('/', \App\Http\Controllers\WelcomeController::class);
Route::resource('authors', \App\Http\Controllers\AuthorController::class)->only('index', 'show');
Route::resource('articles', \App\Http\Controllers\ArticleController::class);
Route::get('articles', function() {
    return view('articles');
});


// USER ROUTES
require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

