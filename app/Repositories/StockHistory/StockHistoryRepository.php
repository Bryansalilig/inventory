<?php

namespace App\Repositories\StockHistory;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Contracts\StockHistory\StockHistoryRepositoryInterface;
use App\Models\StockHistory\StockHistory;

use App\DTOs\StockHistory\StockHistoryDTO;

class StockHistoryRepository implements StockHistoryRepositoryInterface
{
  /**
   * @return Collection<StockHistoryDTO>
   */
  public function getHistory(int $componentId, int $componentStockId, array $filters): array
  {
    $columns = ['id', 'user_id', 'asset_tag'];

    $length = $filters['length'] ?? 10;
    $start = $filters['start'] ?? 0;
    $orderCol = $columns[$filters['order'][0]['column'] ?? 0] ?? 'id';
    $orderDir = $filters['order'][0]['dir'] ?? 'desc';
    $search = $filters['search']['value'] ?? null;

    $baseQuery = StockHistory::query()->where('component_id', $componentId)->where('component_stock_id', $componentStockId);

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
      'data' => StockHistoryDTO::collection($data),
    ];
  }

  /**
   * Store a StockHistory model instance.
   *
   * @param  \App\Models\StockHistory\StockHistory  $history
   */
  public function store(StockHistory $history)
  {
    $history->save();
  }
}
