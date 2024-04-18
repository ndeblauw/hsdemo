<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'welcome']);

Route::get('articles', function() {
    return view('articles');
});
