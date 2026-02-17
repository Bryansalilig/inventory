<?php

namespace App\Services\Cubicles;

use Illuminate\Support\Facades\DB;
use App\Exceptions\ComponentNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Contracts\Cubicles\CubicleServiceInterface;
use App\Contracts\Cubicles\CubicleRepositoryInterface;

class CubicleService implements CubicleServiceInterface
{
  public function __construct(protected CubicleRepositoryInterface $cubicleRepo) {}

  public function getAllCubicle(int $location, array $filters): array
  {
    return $this->cubicleRepo->getAllCubicleById($location, $filters);
  }
}
