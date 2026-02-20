<?php

namespace App\Contracts\Logs;

use Illuminate\Http\Request;

use App\Models\Log\Log;

interface LogRepositoryInterface
{
  /**
   * Fetch components from persistence layer
   */
  public function getAllLog(array $filters): array;

  public function storeAssetMovement(int $componentId, int $componentStockId, string $assetTag, ?string $employeeName, string $action, int $createdBy): Log;
}
