<?php

use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PostDetailController;

// Show Homepage
Route::get('/', function () {
    return view('index');
});

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])
    ->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout']);

// Show Login Form
Route::get('/login', [UserController::class, 'login'])
    ->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Show Profile Page
Route::get('/profile', [UserController::class, 'profile'])
    ->middleware('auth');

// Show Profile Edit Form
Route::get('/profile/edit', [UserController::class, 'edit'])
    ->middleware('auth');

// Update Profile
Route::put('/profile/update', [UserController::class, 'update'])
    ->middleware('auth');

// Show Admin Dashboard
Route::get('/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(CheckAdmin::class);

Route::resource('posts', PostController::class);
Route::post('/posts/{post_id}/likes', [PostController::class, 'like'])->name('posts.like');

Route::resource('reports', ReportController::class);

Route::post('likes/toggle', [LikeController::class, 'toggle'])->name('likes.toggle');
Route::post('likes/delete', [LikeController::class, 'destroy'])->name('likes.delete');
