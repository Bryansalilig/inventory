<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Assets\AssetsController;
use App\Http\Controllers\Components\ComponentsController;
use App\Http\Controllers\ComponentStocks\ComponentStockController;
use App\Http\Controllers\Employees\EmployeeAPIController;

// ----------------------
// Dashboard
// ----------------------
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// ----------------------
// Assets Module
// ----------------------
Route::prefix('assets')
  ->name('assets.')
  ->group(function () {
    Route::get('/', [AssetsController::class, 'index'])->name('index');
    Route::get('/get-data', [AssetsController::class, 'getData'])->name('getData');
    Route::get('/create', [AssetsController::class, 'create'])->name('create');
    Route::post('/', [AssetsController::class, 'store'])->name('store');
    Route::get('/{asset}/edit', [AssetsController::class, 'edit'])->name('edit');
    Route::put('/{asset}', [AssetsController::class, 'update'])->name('update');
    Route::delete('/{asset}', [AssetsController::class, 'destroy'])->name('destroy');
  });

// ----------------------
// Components Module
// ----------------------
Route::prefix('components')
  ->name('components.')
  ->group(function () {
    Route::get('/', [ComponentsController::class, 'index'])->name('index');
    Route::get('/get-data', [ComponentsController::class, 'getData'])->name('getData');
    Route::get('/create', [ComponentsController::class, 'create'])->name('create');
    Route::post('/', [ComponentsController::class, 'store'])->name('store');
    Route::post('/component-checkout', [ComponentsController::class, 'checkout'])->name('component-checkout');
    Route::get('/{order}/edit', [ComponentsController::class, 'edit'])->name('edit');
    Route::get('/{stock}/show', [ComponentsController::class, 'show'])->name('stock');
    Route::put('/{order}', [ComponentsController::class, 'update'])->name('update');
    Route::delete('/{order}', [ComponentsController::class, 'destroy'])->name('destroy');
  });

// ----------------------
// ComponentStock Module
// ----------------------
Route::prefix('components/{component}/stocks')
  ->name('components.stocks.')
  ->group(function () {
    Route::get('/', [ComponentStockController::class, 'index'])->name('index');
    Route::get('/data', [ComponentStockController::class, 'getData'])->name('data');
    Route::get('/create', [ComponentStockController::class, 'create'])->name('create');
    Route::post('/store', [ComponentStockController::class, 'store'])->name('store');
  });

// ----------------------
// EmployeeAPI Module
// ----------------------
Route::prefix('employees')
  ->name('employees.')
  ->group(function () {
    Route::get('/', [EmployeeAPIController::class, 'index'])->name('index');
  });

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
