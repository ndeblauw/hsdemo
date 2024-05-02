<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// PUBLIC routes
Route::get('/', \App\Http\Controllers\WelcomeController::class);
Route::view('/empty', 'empty');

Route::resource('authors', \App\Http\Controllers\AuthorController::class)->only('index', 'show');
Route::resource('categories', \App\Http\Controllers\CategoryController::class)->only('index', 'show');

Route::get('/articles', [\App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{id}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');

Route::get('/search', [\App\Http\Controllers\SearchController::class, 'create'])->name('search.create');
Route::post('/search', [\App\Http\Controllers\SearchController::class, 'store'])->name('search.store');

// USER ROUTES
require __DIR__.'/auth.php';

Route::redirect('/dashboard', 'user/articles')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::resource('articles', \App\Http\Controllers\User\ArticleController::class);
    Route::resource('categories', \App\Http\Controllers\User\CategoryController::class)
        ->middleware(\App\Http\Middleware\IsAdminMiddleware::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
