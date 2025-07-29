<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\Profile\ProfileController;

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

    // Item Import Export
    Route::prefix('items')->group(function () {
        Route::get('/template', [ItemController::class, 'downloadTemplate'])->name('items.template');
        Route::get('/export', [ItemController::class, 'export'])->name('items.export');
        Route::post('/import', [ItemController::class, 'import'])->name('items.import');
    });

    // Item Routes
    Route::resource('items', ItemController::class);

    // Category Routes
    Route::resource('categories', CategoryController::class);

    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/password', [ProfileController::class, 'editPassword'])->name('profile.password.edit');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    });
});

