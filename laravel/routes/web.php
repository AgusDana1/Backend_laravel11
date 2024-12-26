<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YourController;

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