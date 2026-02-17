<?php

namespace App\Repositories\ComponentStocks;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Contracts\ComponentStocks\ComponentStockRepositoryInterface;
use App\Models\ComponentStock\ComponentStock;
use App\DTOs\ComponentStocks\ComponentStockDTO;
use App\DTOs\ComponentStocks\StoreComponentStockDTO;
use App\DTOs\ComponentStocks\ComponentStockDetailDTO;

class ComponentStockRepository implements ComponentStockRepositoryInterface
{
  /**
   * @return Collection<ComponentStockDTO>
   */
  public function getByComponentId(int $componentId, array $filters): array
  {
    $columns = ['id', 'model_type', 'cost', 'quantity', 'available_component', 'specification', 'supplier', 'purchase_date'];

    $length = $filters['length'] ?? 10;
    $start = $filters['start'] ?? 0;
    $orderCol = $columns[$filters['order'][0]['column'] ?? 0] ?? 'id';
    $orderDir = $filters['order'][0]['dir'] ?? 'desc';
    $search = $filters['search']['value'] ?? null;

    $baseQuery = ComponentStock::query()->where('component_id', $componentId);

    $recordsTotal = (clone $baseQuery)->count();

    if ($search) {
      $baseQuery->where(function ($q) use ($search) {
        $q->where('model_type', 'like', "%{$search}%")
          ->orWhere('specification', 'like', "%{$search}%")
          ->orWhere('supplier', 'like', "%{$search}%");
      });
    }

    $recordsFiltered = (clone $baseQuery)->count();

    $data = $baseQuery->orderBy($orderCol, $orderDir)->skip($start)->take($length)->get();

    return [
      'draw' => (int) ($filters['draw'] ?? 1),
      'recordsTotal' => $recordsTotal,
      'recordsFiltered' => $recordsFiltered,
      'data' => ComponentStockDTO::collection($data),
    ];
  }

  /**
   * Store a component in the database
   */
  public function store(StoreComponentStockDTO $dto): void
  {
    // Store in DB
    ComponentStock::create([
      'component_id' => $dto->component_id,
      'model_type' => $dto->model_type,
      'cost' => $dto->cost,
      'quantity' => $dto->quantity,
      'available_component' => $dto->quantity,
      'specification' => $dto->specification,
      'supplier' => $dto->supplier,
      'purchase_date' => $dto->purchase_date,
    ]);
  }

  public function where(...$args)
  {
    return ComponentStock::query()->where(...$args);
  }

  public function findOrFail(int $id): ComponentStock
  {
    return ComponentStock::findOrFail($id);
  }

  public function save(ComponentStock $componentStock): void
  {
    $componentStock->save();
  }

  public function getStockDetail(int $componentId, int $componentStockId)
  {
    $stock = ComponentStock::where('id', $componentStockId)->where('component_id', $componentId)->firstOrFail(); // Throws 404 if not found

    return ComponentStockDetailDTO::fromModel($stock); // Use helper
  }
}
