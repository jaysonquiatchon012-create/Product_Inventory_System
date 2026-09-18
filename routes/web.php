<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InventoryTransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AccountController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);

    Route::get('/inventory-transactions/create', [InventoryTransactionController::class, 'create'])
        ->name('inventory-transactions.create');

    Route::post('/inventory-transactions', [InventoryTransactionController::class, 'store'])
        ->name('inventory-transactions.store');

    Route::get('/inventory-transactions', [InventoryTransactionController::class, 'index'])
        ->name('inventory-transactions.index');
    
    Route::get('/reports', [ReportController::class, 'index']) 
        ->name('reports.index');

    Route::get('/account', [AccountController::class, 'index'])
        ->name('account.index');

    Route::get('/account/edit', [AccountController::class, 'edit'])
        ->name('account.edit');

    Route::put('/account', [AccountController::class, 'update'])
        ->name('account.update');

    Route::get('/account/password', [AccountController::class, 'password'])
        ->name('account.password');

    Route::put('/account/password', [AccountController::class, 'updatePassword'])
        ->name('account.update-password');
});