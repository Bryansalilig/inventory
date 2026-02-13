<?php

namespace App\Contracts\Assets;

use Illuminate\Http\Request;

interface AssetRepositoryInterface
{
  /**
   * Fetch components from persistence layer
   */
  public function getAllAsset(Request $request): array;
}
