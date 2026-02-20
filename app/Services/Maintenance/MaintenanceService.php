<?php
namespace App\Services\Maintenance;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Domain\Maintenance\Enums\MaintenanceStatus;

use App\DTOs\Maintenance\StoreMaintenanceDTO;

use App\Contracts\Maintenance\MaintenanceServiceInterface;
use App\Contracts\Maintenance\MaintenanceRepositoryInterface;
use App\Contracts\Assets\AssetRepositoryInterface;
use App\Contracts\Logs\LogRepositoryInterface;

class MaintenanceService implements MaintenanceServiceInterface
{
  public function __construct(protected MaintenanceRepositoryInterface $maintenanceRepository, protected AssetRepositoryInterface $assetRepository, protected LogRepositoryInterface $logRepository) {}

  public function getAllMaintenance(MaintenanceStatus $status, array $filters): array
  {
    return $this->maintenanceRepository->getByStatus($status, $filters);
  }

  public function storeFromAsset(StoreMaintenanceDTO $dto, int $createdBy): void
  {
    try {
      DB::transaction(function () use ($dto, $createdBy) {
        // 1️⃣ Store maintenance
        $maintenance = $this->maintenanceRepository->storeFromAsset($dto);

        // 2️⃣ Find asset
        $asset = $this->assetRepository->findById($dto->id);

        $action = 'Move to ' . MaintenanceStatus::Maintenance->value;

        // 3️⃣ Store log
        $this->logRepository->storeAssetMovement(componentId: $dto->componentId, componentStockId: $dto->componentStockId, assetTag: $asset->asset_tag, employeeName: $asset->employee_name, action: $action, createdBy: $createdBy);

        // 4️⃣ Delete asset
        $this->assetRepository->deleteById($dto->id);
      });
    } catch (Exception $e) {
      // Optional: log the error
      Log::error('Failed to move asset to maintenance: ' . $e->getMessage());

      // Rethrow so controller can handle / return 500
      throw $e;
    }
  }
}
