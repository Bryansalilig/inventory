<?php
namespace App\Services\ComponentStocks;

use App\Contracts\ComponentStocks\ComponentStockCheckoutServiceInterface;
use App\Repositories\ComponentStocks\ComponentStockRepository;
use App\Repositories\StockHistory\StockHistoryRepository;
use App\Repositories\Assets\AssetRepository;
use App\Repositories\Employees\EmployeeRepository;
use App\Models\Asset\Asset;
use App\Models\Employee\Employee;
use App\Models\StockHistory\StockHistory;
use Illuminate\Support\Facades\DB;
use DomainException;

class ComponentStockCheckoutService implements ComponentStockCheckoutServiceInterface
{
  public function __construct(private ComponentStockRepository $componentStockRepository, private AssetRepository $assetRepository, private StockHistoryRepository $stockHistoryRepository, private EmployeeRepository $employeeRepository) {}

  public function handle(array $data): void
  {
    DB::transaction(function () use ($data) {
      $componentStock = $this->componentStockRepository->where('id', $data['component_stock_id'])->where('available_component', '>=', $data['checkout_qty'])->lockForUpdate()->firstOrFail();

      $generatedAssetTags = []; // para sa Monitor

      if ($componentStock->component->name === 'Monitor' && $data['checkout_qty'] > 1) {
        $baseAssetTag = $data['asset_tag'];

        for ($i = 0; $i < $data['checkout_qty']; $i++) {
          $assetTag = $this->generateAssetTag($baseAssetTag, $i);
          $generatedAssetTags[] = $assetTag;
          $this->createAsset($componentStock, $data, 1, $assetTag);
        }

        $historyAssetTag = json_encode($generatedAssetTags); // Store array for Monitor
      } elseif ($componentStock->component->name === 'Monitor') {
        $generatedAssetTags[] = $data['asset_tag'];
        $this->createAsset($componentStock, $data, 1, $data['asset_tag']);

        $historyAssetTag = $data['asset_tag']; // Single monitor asset
      } else {
        $this->createAsset($componentStock, $data, $data['checkout_qty'], $data['asset_tag']);

        $historyAssetTag = $data['asset_tag']; // Non-monitor
      }

      // Atomically subtract stock
      $componentStock->decrement('available_component', $data['checkout_qty']);

      // Store Employee
      $employee = $this->employeeRepository->store(Employee::storeEmployee(employee_id: $data['employee_id'], cubicle_id: null, employee_name: $data['fullname']));

      // Store history
      $history = StockHistory::checkout(
        componentStock: $componentStock,
        component_id: $data['component_id'],
        user_id: 1,
        asset_tag: $historyAssetTag, // ✅ Monitor = array, Non-Monitor = string
        employee_id: $data['employee_id'],
        employee_name: $data['fullname'],
        quantity: $data['checkout_qty'],
      );

      $this->stockHistoryRepository->store($history);
    });
  }

  private function createAsset($componentStock, array $data, int $quantity, string $assetTag)
  {
    $asset = Asset::fromComponent(componentStock: $componentStock, component_id: $data['component_id'], asset_tag: $assetTag, employeeId: $data['employee_id'], employeeName: $data['fullname'], employeePosition: $data['position'], checkoutDate: $data['checkout_date'], quantity: $quantity);

    $this->assetRepository->store($asset);
  }

  private function generateAssetTag(string $baseTag, int $offset): string
  {
    // Split numeric part (last 6 digits)
    $number = (int) substr($baseTag, -6) + $offset;

    // Keep prefix
    $prefix = substr($baseTag, 0, -6);

    // Combine prefix + new number (padded to 6 digits)
    return $prefix . str_pad($number, 6, '0', STR_PAD_LEFT);
  }
}
