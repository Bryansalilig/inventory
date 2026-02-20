<?php

namespace App\Contracts\Maintenance;

use Illuminate\Http\Request;

use App\Domain\Maintenance\Enums\MaintenanceStatus;

use App\DTOs\Maintenance\StoreMaintenanceDTO;

interface MaintenanceServiceInterface
{
  /**
   * Get maintenance for DataTables
   */
  public function getAllMaintenance(MaintenanceStatus $status, array $filters): array;

  public function storeFromAsset(StoreMaintenanceDTO $dto, int $createdBy): void;
}
