<?php

namespace App\Services\StockHistory;

use Illuminate\Support\Facades\DB;
use App\Exceptions\ComponentNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Models\Asset\Asset;

use App\Http\Requests\Components\StoreComponentRequest;

// use App\DTOs\ComponentStocks\StoreComponentStockDTO;

use App\Contracts\StockHistory\StockHistoryServiceInterface;
use App\Contracts\StockHistory\StockHistoryRepositoryInterface;

class StockHistoryService implements StockHistoryServiceInterface
{
  public function __construct(protected StockHistoryRepositoryInterface $stockHistoryRepo) {}

  public function getHistory(int $componentId, int $componentStockId, array $filters): array
  {
    return $this->stockHistoryRepo->getHistory(componentId: $componentId, componentStockId: $componentStockId, filters: $filters);
  }
}
