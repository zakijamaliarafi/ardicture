<?php

use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CommentController;

// Show Homepage
Route::get('/', [PostController::class, 'index'])->name('home');

// About Us
Route::get('/about', [PostController::class, 'about'])->name('about');

// Show Search Results
Route::get('/search', [PostController::class, 'search']);

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])
    ->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout']);

// Show Login Form
Route::get('/login', [UserController::class, 'login'])
    ->middleware('guest')->name('login');

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

Route::get('/profile/{liked}', [UserController::class, 'profile_liked'])
    ->middleware('auth');

// Show Admin Dashboard
Route::get('/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(CheckAdmin::class);

// Route::resource('posts', PostController::class);
Route::post('/posts/{post_id}/likes', [PostController::class, 'like'])->name('posts.like');

Route::get('/reports', [ReportController::class, 'index'])->name('reports.show');

Route::post('reports/toggle', [ReportController::class, 'toggle'])->name('reports.toggle');

//Route::post('/reports/toggle', [ReportsController::class, 'toggle'])->name('reports.toggle');
Route::delete('/reports/destroy/{id}', [ReportController::class, 'destroy'])->name('reports.destroy');

Route::post('likes/toggle', [LikeController::class, 'toggle'])->name('likes.toggle');

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

// Delete Post
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')
    ->middleware('auth');

// Show Post Detail
Route::get('/posts/{post}', [PostController::class, 'show'])
    ->name('posts.show');

//Route::post('/posts/destroy', [PostController::class, 'destroy'])->name();

// Add New Tag
Route::post('/tags/store', [TagController::class, 'store']);

// Show Post by Tag
Route::get('/tags/{tag}', [TagController::class, 'show']);

// Create New Comment
Route::post('/comments/store', [CommentController::class, 'store']);

// Update Comment
Route::put('/comments/{comment}/update', [CommentController::class, 'update'])
    ->middleware('auth');

// Delete Comment
Route::delete('/comments/{comment}/delete', [CommentController::class, 'destroy'])
    ->middleware('auth');
