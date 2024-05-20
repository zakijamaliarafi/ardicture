<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);
