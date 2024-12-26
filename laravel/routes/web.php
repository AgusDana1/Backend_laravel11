<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YourController;
use App\Http\Controllers\Auth\GoogleController;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/posts', [PostController::class, 'index']);

// api resource "Items"
Route::get('/items', [YourController::class, 'index']);
Route::get('/items/{id}', [YourController::class, 'show']);
Route::post('/items', [YourController::class, 'store']);
Route::put('/items/{id}', [YourController::class, 'update']);
Route::delete('/items/{id}', [YourController::class, 'destroy']);

// google authentication
Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);