<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/posts', [\App\Http\Controllers\Api\PostController::class, 'index']);
Route::post('/posts', [\App\Http\Controllers\Api\PostController::class, 'store']);
Route::get('/posts/{post}', [\App\Http\Controllers\Api\PostController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('abilities:users.index')->get('/users', [\App\Http\Controllers\Api\UserController::class, 'index']);
    Route::get('/users/{user}', [\App\Http\Controllers\Api\UserController::class, 'show']);
});


/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
