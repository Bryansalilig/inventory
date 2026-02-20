<?php

namespace App\Repositories\Maintenance;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Domain\Maintenance\Enums\MaintenanceStatus;

use App\Contracts\Maintenance\MaintenanceRepositoryInterface;
use App\Models\Maintenance\Maintenance;
use App\DTOs\Maintenance\MaintenanceDTO;
use App\DTOs\Maintenance\StoreMaintenanceDTO;

class MaintenanceRepository implements MaintenanceRepositoryInterface
{
  /**
   * @return Collection<MaintenanceDTO>
   */
  public function getByStatus(MaintenanceStatus $status, array $filters): array
  {
    $columns = ['id'];

    $length = $filters['length'] ?? 10;
    $start = $filters['start'] ?? 0;
    $orderCol = $columns[$filters['order'][0]['column'] ?? 0] ?? 'id';
    $orderDir = $filters['order'][0]['dir'] ?? 'desc';
    $search = $filters['search']['value'] ?? null;

    $baseQuery = Maintenance::query()->where('status', $status);

    $recordsTotal = (clone $baseQuery)->count();

    if ($search) {
      $baseQuery->where(function ($q) use ($search) {
        $q->where('asset_tag', 'like', "%{$search}%");
      });
    }

    $recordsFiltered = (clone $baseQuery)->count();

    $data = $baseQuery->orderBy($orderCol, $orderDir)->skip($start)->take($length)->get();

    return [
      'draw' => (int) ($filters['draw'] ?? 1),
      'recordsTotal' => $recordsTotal,
      'recordsFiltered' => $recordsFiltered,
      'data' => MaintenanceDTO::collection($data),
    ];
  }

  public function storeFromAsset(StoreMaintenanceDTO $dto): Maintenance
  {
    return Maintenance::create([
      'component_id' => $dto->componentId,
      'component_stock_id' => $dto->componentStockId,
      'employee_id' => $dto->employeeId,
      'description' => $dto->description,
      'asset_tag' => $dto->assetTag,
      'status' => MaintenanceStatus::Maintenance->value,
    ]);
  }
}
