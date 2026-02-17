<?php
namespace App\Services\ComponentStocks;

use App\Contracts\ComponentStocks\ComponentStockCheckoutServiceInterface;
use App\Repositories\ComponentStocks\ComponentStockRepository;
use App\Repositories\StockHistory\StockHistoryRepository;
use App\Repositories\Assets\AssetRepository;
use App\Models\Asset\Asset;
use App\Models\StockHistory\StockHistory;
use Illuminate\Support\Facades\DB;
use DomainException;

class ComponentStockCheckoutService implements ComponentStockCheckoutServiceInterface
{
  public function __construct(private ComponentStockRepository $componentStockRepository, private AssetRepository $assetRepository, private StockHistoryRepository $stockHistoryRepository) {}

  public function handle(array $data): void
  {
    DB::transaction(function () use ($data) {
      // ✅ Lock the stock row to prevent race conditions
      $componentStock = $this->componentStockRepository->where('id', $data['component_stock_id'])->where('available_component', '>=', $data['checkout_qty'])->lockForUpdate()->firstOrFail();

      // Create Asset
      $asset = Asset::fromComponent(
        componentStock: $componentStock,
        component_id: $data['component_id'],
        asset_tag: $data['asset_tag'],
        employeeId: $data['employee_id'],
        employeeName: $data['fullname'],
        employeePosition: $data['position'],
        checkoutDate: $data['checkout_date'],
        quantity: $data['checkout_qty'],
      );

      // Store Asset
      $this->assetRepository->store($asset);

      // ✅ Atomically subtract stock
      $componentStock->decrement('available_component', $data['checkout_qty']);

      // Store history
      $history = StockHistory::checkout(
        componentStock: $componentStock,
        component_id: $data['component_id'],
        user_id: 1,
        asset_tag: $data['asset_tag'],
        employee_id: $data['employee_id'],
        employee_name: $data['fullname'],
        quantity: $data['checkout_qty'],
      );

      $this->stockHistoryRepository->store($history);
    });
  }
}
