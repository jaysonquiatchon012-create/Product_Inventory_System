<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
});