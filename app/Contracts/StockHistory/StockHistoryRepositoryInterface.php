<?php

namespace App\Contracts\StockHistory;

use Illuminate\Http\Request;

use App\Models\StockHistory\StockHistory;

interface StockHistoryRepositoryInterface
{
  /**
   * Store component stock from persistence layer
   */
  public function getHistory(int $componentId, int $componentStockId, array $filters): array;

  public function store(StockHistory $history);
}
