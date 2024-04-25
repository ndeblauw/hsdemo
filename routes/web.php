<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// PUBLIC routes
Route::get('/', \App\Http\Controllers\WelcomeController::class);
Route::resource('authors', \App\Http\Controllers\AuthorController::class)->only('index', 'show');
Route::get('/articles', [\App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{id}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');



// USER ROUTES
require __DIR__.'/auth.php';



Route::redirect('/dashboard', 'user/articles')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('user')->name('user.')->group( function() {
    Route::resource('articles', \App\Http\Controllers\User\ArticleController::class);
    Route::resource('categories', \App\Http\Controllers\User\CategoryController::class);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

