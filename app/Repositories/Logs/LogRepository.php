<?php

namespace App\Repositories\Logs;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Contracts\Logs\LogRepositoryInterface;
use App\Models\Log\Log;
use App\DTOs\Logs\LogDTO;

class LogRepository implements LogRepositoryInterface
{
  /**
   * @return Collection<LogDTO>
   */
  public function getAllLog(array $filters): array
  {
    $columns = ['id'];

    $length = $filters['length'] ?? 10;
    $start = $filters['start'] ?? 0;
    $orderCol = $columns[$filters['order'][0]['column'] ?? 0] ?? 'id';
    $orderDir = $filters['order'][0]['dir'] ?? 'desc';
    $search = $filters['search']['value'] ?? null;

    $baseQuery = Log::query();

    $recordsTotal = (clone $baseQuery)->count();

    if ($search) {
      $baseQuery->where(function ($q) use ($search) {
        $q->where('employee_name', 'like', "%{$search}%")->orWhere('asset_tag', 'like', "%{$search}%");
      });
    }

    $recordsFiltered = (clone $baseQuery)->count();

    $data = $baseQuery->orderBy($orderCol, $orderDir)->skip($start)->take($length)->get();

    return [
      'draw' => (int) ($filters['draw'] ?? 1),
      'recordsTotal' => $recordsTotal,
      'recordsFiltered' => $recordsFiltered,
      'data' => LogDTO::collection($data),
    ];
  }

  public function storeAssetMovement(int $componentId, int $componentStockId, string $assetTag, ?string $employeeName, string $action, int $createdBy): Log
  {
    return Log::create([
      'component_id' => $componentId,
      'component_stock_id' => $componentStockId,
      'asset_tag' => $assetTag,
      'employee_name' => $employeeName,
      'action' => $action,
      'created_by' => $createdBy,
    ]);
  }
}
