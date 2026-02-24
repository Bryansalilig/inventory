<?php

namespace App\Services\Assets;

use Illuminate\Support\Facades\DB;
use App\Exceptions\ComponentNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\DTOs\Components\StoreComponentDTO;

use App\DTOs\Assets\UpdateAssetDTO;

use App\Contracts\Assets\AssetServiceInterface;
use App\Contracts\Assets\AssetRepositoryInterface;

class AssetService implements AssetServiceInterface
{
  public function __construct(protected AssetRepositoryInterface $assetRepository) {}

  public function getAllAsset(Request $request): array
  {
    return $this->assetRepository->getAllAsset($request);
  }

  public function updateAsset(UpdateAssetDTO $dto): void
  {
    DB::transaction(function () use ($dto) {
      $this->assetRepository->reassignAsset(componentId: $dto->componentId, assetTag: $dto->assetTag, newAssetId: $dto->selectedAssetId);
    });
  }
}
