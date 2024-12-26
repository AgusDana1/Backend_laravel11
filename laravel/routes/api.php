<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

// api Post
Route::apiResource('/posts', PostController::class);