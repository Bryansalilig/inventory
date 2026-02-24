<?php

namespace App\Contracts\Assets;

use Illuminate\Http\Request;

use App\DTOs\Assets\UpdateAssetDTO;

interface AssetServiceInterface
{
  /**
   * Get assets for DataTables
   */
  public function getAllAsset(Request $request): array;

  public function updateAsset(UpdateAssetDTO $dto): void;
}
