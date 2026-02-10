<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
// use App\Http\Controllers\OrderController;
// use App\Http\Controllers\SupplierController;

// ----------------------
// Dashboard
// ----------------------
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// ----------------------
// Orders Module
// ----------------------
// Route::prefix('orders')
//   ->name('orders.')
//   ->group(function () {
//     Route::get('/', [OrderController::class, 'index'])->name('index');
//     Route::get('/create', [OrderController::class, 'create'])->name('create');
//     Route::post('/', [OrderController::class, 'store'])->name('store');
//     Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('edit');
//     Route::put('/{order}', [OrderController::class, 'update'])->name('update');
//     Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');
//   });

// ----------------------
// Suppliers Module
// ----------------------
// Route::prefix('suppliers')
//   ->name('suppliers.')
//   ->group(function () {
//     Route::get('/', [SupplierController::class, 'index'])->name('index');
//     Route::get('/create', [SupplierController::class, 'create'])->name('create');
//     Route::post('/', [SupplierController::class, 'store'])->name('store');
//     Route::get('/{supplier}/edit', [SupplierController::class, 'edit'])->name('edit');
//     Route::put('/{supplier}', [SupplierController::class, 'update'])->name('update');
//     Route::delete('/{supplier}', [SupplierController::class, 'destroy'])->name('destroy');
//   });
