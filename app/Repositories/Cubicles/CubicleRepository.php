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
    $length = $filters['length'] ?? 10;
    $start = $filters['start'] ?? 0;
    $search = $filters['search']['value'] ?? null;

    $baseQuery = Cubicle::query()->where('location', $location);

    $recordsTotal = (clone $baseQuery)->count();

    if ($search) {
      $baseQuery->where(function ($q) use ($search) {
        $q->where('name', 'like', "%{$search}%");
      });
    }

    $recordsFiltered = (clone $baseQuery)->count();

    $allData = $baseQuery->get()->sort(function ($a, $b) {
      preg_match('/^([A-Z]+)(\d+)$/', $a->name, $matchA);
      preg_match('/^([A-Z]+)(\d+)$/', $b->name, $matchB);

      $prefixCmp = strcmp($matchA[1], $matchB[1]);
      if ($prefixCmp !== 0) {
        return $prefixCmp;
      }

      return intval($matchA[2]) <=> intval($matchB[2]);
    });

    // Reindex after slice
    $pagedData = $allData->slice($start, $length)->values();

    return [
      'draw' => (int) ($filters['draw'] ?? 1),
      'recordsTotal' => $recordsTotal,
      'recordsFiltered' => $recordsFiltered,
      'data' => CubicleDTO::collection($pagedData),
    ];
  }

  public function storeSingle(int $location, string $name): void
  {
    Cubicle::create([
      'location' => $location,
      'name' => $name,
    ]);
  }
}
