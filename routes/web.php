<?php

use App\Models\Post;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostDetailController;

// Show Homepage
Route::get('/', [PostController::class, 'index']);

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

// Show User by Id
Route::get('/users/{user}', [UserController::class, 'profile'])
->name('users.profile');

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

// Route::resource('posts', PostController::class);

// Show Create Post Form
Route::get('/posts/create', [PostController::class, 'create'])
->middleware('auth');

// Create New Post
Route::post('/posts/store', [PostController::class, 'store'])
->middleware('auth');

// Show Edit Form
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
->middleware('auth');

// Update Post
Route::put('/posts/{post}', [PostController::class, 'update'])
->middleware('auth');

// Delete Listing
Route::delete('/posts/{post}', [PostController::class, 'destroy'])
->middleware('auth');

// Show Post Detail
Route::get('/posts/{post}', [PostController::class, 'show'])
->name('posts.show');

// Add New Tag
Route::post('/tags/store', [TagController::class, 'store']);

// Show Post by Tag
Route::get('/tags/{tag}', [TagController::class, 'show']);

Route::post('/comments/store', [CommentController::class, 'store']);
