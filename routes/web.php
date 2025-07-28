<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Item\ItemController;

// Protect Auth Routes
Route::middleware('guest.only')->group(function () {

    // Page Login Routes
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');

    // Login Post Routes
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout Routes
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// CRUD Routes
Route::middleware(['auth', 'double.auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Item Routes
    Route::resource('items', ItemController::class);
    // kasih deksripsi
    Route::prefix('items')->group(function () {
    Route::get('/export', [ItemController::class, 'export'])->name('items.export');
    Route::post('/import', [ItemController::class, 'import'])->name('items.import');
});

    // Category Routes
    Route::resource('categories', CategoryController::class);
});
