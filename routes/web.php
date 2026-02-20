<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Assets\AssetsController;
use App\Http\Controllers\Components\ComponentsController;
use App\Http\Controllers\ComponentStocks\ComponentStockController;
use App\Http\Controllers\Employees\EmployeeAPIController;
use App\Http\Controllers\Employees\EmployeeController;
use App\Http\Controllers\Cubicles\CubicleController;
use App\Http\Controllers\Maintenance\MaintenanceController;
use App\Http\Controllers\Logs\LogController;

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
    Route::get('/{stock}/detail', [ComponentStockController::class, 'detail'])->name('detail');
    Route::get('/{stock}/history', [ComponentStockController::class, 'history'])->name('history');
    Route::get('/{stock}/stock-detail', [ComponentStockController::class, 'stockDetail'])->name('stockDetail');
    Route::post('/store', [ComponentStockController::class, 'store'])->name('store');
    Route::post('/checkout', [ComponentStockController::class, 'checkout'])->name('checkout');
  });

// ----------------------
// Cubicles Module
// ----------------------
Route::prefix('cubicles')
  ->name('cubicles.')
  ->group(function () {
    Route::get('/', [CubicleController::class, 'index'])->name('index');
    Route::get('/{location}/get-cubicles', [CubicleController::class, 'getCubicles'])->name('getCubicles');
    Route::get('/last', [CubicleController::class, 'getLastCubicle'])->name('getLastCubicle');
    Route::post('/store', [CubicleController::class, 'store'])->name('store');
  });

// ----------------------
// Employees Module
// ----------------------
Route::prefix('employees')
  ->name('employees.')
  ->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('index');
    Route::get('/get-data', [EmployeeController::class, 'getData'])->name('getData');
  });

// ----------------------
// Maintenance Module
// ----------------------
Route::prefix('maintenance')
  ->name('maintenance.')
  ->group(function () {
    Route::get('/', [MaintenanceController::class, 'index'])->name('index');
    Route::get('/{status}/get-data', [MaintenanceController::class, 'getData'])->name('getData');
    Route::post('/', [MaintenanceController::class, 'store'])->name('store');
  });

// ----------------------
// Logs Module
// ----------------------
Route::prefix('logs')
  ->name('logs.')
  ->group(function () {
    Route::get('/', [LogController::class, 'index'])->name('index');
    Route::get('/get-data', [LogController::class, 'getData'])->name('getData');
  });

// ----------------------
// EmployeeAPI Module
// ----------------------
Route::prefix('employees-api')
  ->name('employees-api.')
  ->group(function () {
    Route::get('/', [EmployeeAPIController::class, 'index'])->name('index');
    Route::get('/{component}/emp-filtered', [EmployeeAPIController::class, 'employeeFiltered'])->name('employeeFiltered');
  });
