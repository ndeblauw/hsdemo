<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\WelcomeController::class);

Route::resource('authors', \App\Http\Controllers\AuthorController::class)->only('index', 'show');


Route::get('articles', function() {
    return view('articles');
});
