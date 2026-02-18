<?php

namespace App\Contracts\Cubicles;

use Illuminate\Http\Request;

use App\DTOs\Cubicles\StoreCubicleDTO;

interface CubicleServiceInterface
{
  /**
   * Get component stocks for DataTables
   */
  public function getAllCubicle(int $location, array $filters): array;

  public function store(StoreCubicleDTO $dto): void;
}
