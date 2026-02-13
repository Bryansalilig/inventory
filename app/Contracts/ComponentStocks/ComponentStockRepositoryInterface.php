<?php

namespace App\Contracts\ComponentStocks;

use Illuminate\Http\Request;

interface ComponentStockRepositoryInterface
{
  /**
   * Fetch components from persistence layer
   */
  public function getAllComponentStock(Request $request): array;
}
