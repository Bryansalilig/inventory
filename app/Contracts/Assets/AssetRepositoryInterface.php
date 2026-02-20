<?php

namespace App\Contracts\Assets;

use Illuminate\Http\Request;

use App\Models\Asset\Asset;

interface AssetRepositoryInterface
{
  /**
   * Fetch components from persistence layer
   */
  public function getAllAsset(Request $request): array;

  public function findById(int $id): Asset;

  public function deleteById(int $id): bool;
}
