<?php

namespace App\Contracts\ComponentStocks;

use Illuminate\Http\Request;

use App\DTOs\ComponentStocks\StoreComponentStockDTO;

interface ComponentStockServiceInterface
{
  /**
   * Get component stocks for DataTables
   */
  public function getAllComponentStock(int $componentId, array $filters): array;

  public function store(StoreComponentStockDTO $dto): void;

  public function getStockDetail(int $componentId, int $componentStockId);
}
