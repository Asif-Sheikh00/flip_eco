<?php

use Illuminate\Support\Facades\Route;

// Middlewares
use App\Http\Middleware\AdminMiddleware;

// Admin Controllers
use App\Http\Controllers\Admin\{CategoryController};

// middleware(['auth', AdminMiddleware::class])->
Route::prefix('admin')->name('admin.')->group(function () {
    Route::view('/dashboard', 'admin.index')->name('dashboard');

    Route::view('/users', 'admin.user.index')->name('user.index');
    Route::view('/users/create', 'admin.user.create')->name('user.create');
    Route::view('/users/edit', 'admin.user.edit')->name('user.edit');

    // Categories Routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
});