<?php

namespace App\Contracts\Assets;

use Illuminate\Http\Request;

interface AssetServiceInterface
{
  /**
   * Get assets for DataTables
   */
  public function getAllAsset(Request $request): array;
}
