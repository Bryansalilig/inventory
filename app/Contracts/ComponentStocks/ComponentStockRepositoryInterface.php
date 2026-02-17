<?php

namespace App\Contracts\ComponentStocks;

use Illuminate\Http\Request;

use App\DTOs\ComponentStocks\StoreComponentStockDTO;

interface ComponentStockRepositoryInterface
{
  /**
   * Fetch components from persistence layer
   */
  public function getByComponentId(int $componentId, array $filters): array;

  public function store(StoreComponentStockDTO $dto): void;

  public function getStockDetail(int $componentId, int $componentStockId);
}
