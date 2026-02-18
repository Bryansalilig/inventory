<?php

namespace App\Contracts\Cubicles;

use Illuminate\Http\Request;

interface CubicleRepositoryInterface
{
  /**
   * Fetch components from persistence layer
   */
  public function getAllCubicleById(int $location, array $filters): array;

  public function storeSingle(int $location, string $name): void;
}
