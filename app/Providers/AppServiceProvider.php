<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Asset Services & Contracts & Repository
use App\Services\Assets\AssetService;
use App\Repositories\Assets\AssetRepository;
use App\Contracts\Assets\AssetServiceInterface;
use App\Contracts\Assets\AssetRepositoryInterface;

// Component Services & Contracts & Repository
use App\Services\Components\ComponentService;
use App\Repositories\Components\ComponentRepository;
use App\Contracts\Components\ComponentServiceInterface;
use App\Contracts\Components\ComponentRepositoryInterface;

// Component Stocks Services & Contracts & Repository
use App\Services\ComponentStocks\ComponentStockService;
use App\Repositories\ComponentStocks\ComponentStockRepository;
use App\Contracts\ComponentStocks\ComponentStockServiceInterface;
use App\Contracts\ComponentStocks\ComponentStockRepositoryInterface;

// Component Checkout Services & Contracts & Repository
use App\Services\ComponentStocks\ComponentStockCheckoutService;
use App\Contracts\ComponentStocks\ComponentStockCheckoutServiceInterface;

// StockHistory Services & Contracts & Repository
use App\Services\StockHistory\StockHistoryService;
use App\Repositories\StockHistory\StockHistoryRepository;
use App\Contracts\StockHistory\StockHistoryServiceInterface;
use App\Contracts\StockHistory\StockHistoryRepositoryInterface;

// Cubicles Services & Contracts & Repository
use App\Services\Cubicles\CubicleService;
use App\Repositories\Cubicles\CubicleRepository;
use App\Contracts\Cubicles\CubicleServiceInterface;
use App\Contracts\Cubicles\CubicleRepositoryInterface;

// Employees Services & Contracts & Repository
use App\Services\Employees\EmployeeService;
use App\Repositories\Employees\EmployeeRepository;
use App\Contracts\Employees\EmployeeServiceInterface;
use App\Contracts\Employees\EmployeeRepositoryInterface;

// Maintenance Services & Contracts & Repository
use App\Services\Maintenance\MaintenanceService;
use App\Repositories\Maintenance\MaintenanceRepository;
use App\Contracts\Maintenance\MaintenanceServiceInterface;
use App\Contracts\Maintenance\MaintenanceRepositoryInterface;

// Logs Services & Contracts & Repository
use App\Services\Logs\LogService;
use App\Repositories\Logs\LogRepository;
use App\Contracts\Logs\LogServiceInterface;
use App\Contracts\Logs\LogRepositoryInterface;

// EmployeeAPI Services & Contracts & Repository
use App\Services\Employees\EmployeeApiService;
use App\Contracts\Employees\EmployeeApiServiceInterface;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    $this->app->bind(ComponentServiceInterface::class, ComponentService::class);
    $this->app->bind(ComponentStockCheckoutServiceInterface::class, ComponentStockCheckoutService::class);
    $this->app->bind(ComponentStockServiceInterface::class, ComponentStockService::class);
    $this->app->bind(ComponentStockRepositoryInterface::class, ComponentStockRepository::class);
    $this->app->bind(ComponentRepositoryInterface::class, ComponentRepository::class);
    $this->app->bind(AssetServiceInterface::class, AssetService::class);
    $this->app->bind(AssetRepositoryInterface::class, AssetRepository::class);
    $this->app->bind(StockHistoryServiceInterface::class, StockHistoryService::class);
    $this->app->bind(StockHistoryRepositoryInterface::class, StockHistoryRepository::class);
    $this->app->bind(EmployeeApiServiceInterface::class, EmployeeApiService::class);
    $this->app->bind(CubicleServiceInterface::class, CubicleService::class);
    $this->app->bind(CubicleRepositoryInterface::class, CubicleRepository::class);
    $this->app->bind(EmployeeServiceInterface::class, EmployeeService::class);
    $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
    $this->app->bind(MaintenanceServiceInterface::class, MaintenanceService::class);
    $this->app->bind(MaintenanceRepositoryInterface::class, MaintenanceRepository::class);
    $this->app->bind(LogServiceInterface::class, LogService::class);
    $this->app->bind(LogRepositoryInterface::class, LogRepository::class);
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    //
  }
}
