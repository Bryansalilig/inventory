<?php

namespace App\Contracts\Cubicles;

use Illuminate\Http\Request;

interface CubicleServiceInterface
{
  /**
   * Get component stocks for DataTables
   */
  public function getAllCubicle(int $location, array $filters): array;
}
