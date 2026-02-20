<?php

namespace App\DTOs\Maintenance;

class StoreMaintenanceDTO
{
  public function __construct(public int $id, public int $componentId, public int $componentStockId, public int $employeeId, public string $description, public string $assetTag) {}
}
