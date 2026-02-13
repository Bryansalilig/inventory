<?php

namespace App\Services\Assets;

use Illuminate\Support\Facades\DB;
use App\Exceptions\ComponentNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\DTOs\Components\StoreComponentDTO;

use App\Contracts\Assets\AssetServiceInterface;
use App\Contracts\Assets\AssetRepositoryInterface;

class AssetService implements AssetServiceInterface
{
  public function __construct(protected AssetRepositoryInterface $componentRepo) {}

  public function getAllAsset(Request $request): array
  {
    return $this->componentRepo->getAllAsset($request);
  }

  // public function store(StoreComponentDTO $dto): void
  // {
  //   try {
  //     DB::transaction(function () use ($dto) {
  //       $this->componentRepo->store($dto);
  //     });
  //   } catch (\Throwable $e) {
  //     // log error
  //     \Log::error('Failed to store component', [
  //       'message' => $e->getMessage(),
  //       'dto' => $dto,
  //     ]);

  //     // rethrow or custom domain exception
  //     throw new \RuntimeException('Failed to store component. Please try again.');
  //   }
  // }
}
