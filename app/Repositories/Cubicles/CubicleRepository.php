<?php

namespace App\Repositories\Cubicles;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Contracts\Cubicles\CubicleRepositoryInterface;
use App\Models\Cubicle\Cubicle;
use App\DTOs\Cubicles\CubicleDTO;

class CubicleRepository implements CubicleRepositoryInterface
{
  /**
   * @return Collection<CubicleDTO>
   */
  public function getAllCubicleById(int $location, array $filters): array
  {
    $columns = ['id', 'location'];

    $length = $filters['length'] ?? 10;
    $start = $filters['start'] ?? 0;
    $orderCol = $columns[$filters['order'][0]['column'] ?? 0] ?? 'id';
    $orderDir = $filters['order'][0]['dir'] ?? 'desc';
    $search = $filters['search']['value'] ?? null;

    $baseQuery = Cubicle::query()->where('location', $location);

    $recordsTotal = (clone $baseQuery)->count();

    if ($search) {
      $baseQuery->where(function ($q) use ($search) {
        $q->where('name', 'like', "%{$search}%");
      });
    }

    $recordsFiltered = (clone $baseQuery)->count();

    $data = $baseQuery->orderBy($orderCol, $orderDir)->skip($start)->take($length)->get();

    return [
      'draw' => (int) ($filters['draw'] ?? 1),
      'recordsTotal' => $recordsTotal,
      'recordsFiltered' => $recordsFiltered,
      'data' => CubicleDTO::collection($data),
    ];
  }
}
