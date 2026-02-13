<?php

namespace App\Contracts\Components;

use Illuminate\Http\Request;

interface ComponentServiceInterface
{
  /**
   * Get components for DataTables
   */
  public function getAllComponent(Request $request): array;
}
