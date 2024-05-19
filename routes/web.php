<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostDetail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class)
    ->only(['index', 'create', 'store', 'edit', 'update']);

Route::get('/posts/{post_id}', [PostDetail::class, 'index']);
