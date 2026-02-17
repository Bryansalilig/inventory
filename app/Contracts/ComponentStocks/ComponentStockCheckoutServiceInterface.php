<?php

namespace App\Contracts\ComponentStocks;

use Illuminate\Http\Request;

interface ComponentStockCheckoutServiceInterface
{
  /**
   * Get handle checkout
   */
  public function handle(array $data): void;
}
