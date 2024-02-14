<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Categories landing page
Route::get('/news/categories', [NewsController::class, 'categories'])->name('news.categories');

// Restore trashed category
Route::post('/categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');

// Category soft delete
Route::delete('/categories/{category}', [CategoryController::class, 'softDelete'])->name('categories.softDelete');

// Soft deleted categories landing page
Route::get('/categories/trashed', [CategoryController::class, 'trashed'])->name('categories.trashed');

// Single category landing page
Route::get('/news/categories/{category}', [NewsController::class, 'categoryNews'])->name('news.category.news');



Route::middleware('auth')->group(function () {
    // Restore trashed news
    Route::post('/news/{news}/restore', [NewsController::class, 'restore'])->name('news.restore');

    // Force delete news
    Route::delete('/news/{news}/forceDelete', [NewsController::class, 'forceDelete'])->name('news.forceDelete');

    // Manage news
    Route::get('/news/manage', [NewsController::class, 'manage']);

    // Trashed news
    Route::get('/news/trash', [NewsController::class, 'trash'])->name('news.trash');

    // Resourceful routes for NewsController
    Route::resource('news', NewsController::class);

    // Comments
    Route::resource('comments', CommentController::class);

    // Log user out
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    // Show register user form
    Route::get('/register', [UserController::class, 'create'])->name('users.create');

    // Show login form
    Route::get('/login', [UserController::class, 'login'])->name('login');
    
    // Store new user data
    Route::post('/users', [UserController::class, 'store'])->name('users.register');

    // Log user in
    Route::post('/users/authenticate', [UserController::class, 'authenticate'])->name('users.authenticate');
});

// All news
Route::get('/', [NewsController::class, 'index']);

// Single news
Route::get('/news/{news}', [NewsController::class, 'show']);


