<?php

namespace App\Contracts\ComponentStocks;

use Illuminate\Http\Request;

interface ComponentStockServiceInterface
{
  /**
   * Get component stocks for DataTables
   */
  public function getAllComponentStock(Request $request): array;
}
