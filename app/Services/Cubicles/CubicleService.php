<?php

namespace App\Services\Cubicles;

use Illuminate\Support\Facades\DB;
use App\Exceptions\ComponentNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\DTOs\Cubicles\StoreCubicleDTO;
use App\DTOs\Cubicles\CubicleDropDownDTO;

use App\Contracts\Cubicles\CubicleServiceInterface;
use App\Contracts\Cubicles\CubicleRepositoryInterface;

class CubicleService implements CubicleServiceInterface
{
  public function __construct(protected CubicleRepositoryInterface $cubicleRepository) {}

  public function getAllCubicle(int $location, array $filters): array
  {
    return $this->cubicleRepository->getAllCubicleById($location, $filters);
  }

  public function store(StoreCubicleDTO $dto): void
  {
    try {
      DB::transaction(function () use ($dto) {
        // Parse last cubicle (C1 → C + 1)
        $parsed = $this->parseCubicle($dto->last_cubicle);
        $prefix = $parsed['prefix'];
        $lastNumber = $parsed['number'];

        // Generate new cubicles based on quantity
        for ($i = 1; $i <= $dto->quantity; $i++) {
          $newName = $prefix . ($lastNumber + $i);

          $this->cubicleRepo->storeSingle(location: $dto->location, name: $newName);
        }
      });
    } catch (\Throwable $e) {
      \Log::error('Failed to store cubicle/s', [
        'message' => $e->getMessage(),
        'dto' => $dto,
      ]);

      throw new \RuntimeException('Failed to store cubicle/s. Please try again.');
    }
  }

  public function cubicleDropdown()
  {
    $cubicles = $this->cubicleRepository->getDropdown();

    return CubicleDropDownDTO::collection($cubicles);
  }

  private function parseCubicle(string $code): array
  {
    preg_match('/^([A-Z]+)(\d+)$/', $code, $matches);

    return [
      'prefix' => $matches[1], // C
      'number' => (int) $matches[2], // 1
    ];
  }
}
