<?php

namespace App\Contracts\StockHistory;

use Illuminate\Http\Request;

interface StockHistoryRepositoryInterface
{
  /**
   * Store component stock from persistence layer
   */
  public function getHistory(int $componentId, int $componentStockId, array $filters): array;
}
