<?php

namespace App\Contracts\Components;

use Illuminate\Http\Request;

interface ComponentCheckoutServiceInterface
{
  /**
   * Get handle checkout
   */
  public function handle(array $data): void;
}
