<?php

namespace App\Contracts\Maintenance;

use Illuminate\Http\Request;

use App\Domain\Maintenance\Enums\MaintenanceStatus;

use App\DTOs\Maintenance\StoreMaintenanceDTO;

use App\Models\Maintenance\Maintenance;

interface MaintenanceRepositoryInterface
{
  /**
   * Fetch maintenance from persistence layer
   */
  public function getByStatus(MaintenanceStatus $status, array $filters): array;

  public function storeFromAsset(StoreMaintenanceDTO $dto): Maintenance;
}
