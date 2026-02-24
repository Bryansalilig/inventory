<?php

namespace App\Repositories\Assets;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Contracts\Assets\AssetRepositoryInterface;
use App\Models\Asset\Asset;
use App\DTOs\Assets\AssetDTO;
use App\DTOs\Components\StoreComponentDTO;

class AssetRepository implements AssetRepositoryInterface
{
  /**
   * @return Collection<AssetDTO>
   */
  public function getAllAsset(Request $request): array
  {
    $columns = ['id', 'employee_id', 'employee_name', 'employee_position', 'deployed_date'];

    $length = $request->input('length', 10);
    $start = $request->input('start', 0);
    $orderCol = $columns[$request->input('order.0.column', 0)] ?? 'id';
    $orderDir = $request->input('order.0.dir', 'desc');
    $search = $request->input('search.value');

    $query = Asset::query()->with('component', 'stock');

    if ($search) {
      $query->where(
        fn($q) => $q
          ->where('employee_name', 'like', "%{$search}%")
          ->orWhere('employee_position', 'like', "%{$search}%")
          ->orWhere('asset_tag', 'like', "%{$search}%"),
      );
    }

    $recordsFiltered = $query->count();
    $recordsTotal = Asset::count();

    $assets = $query->orderBy($orderCol, $orderDir)->skip($start)->take($length)->get();

    return [
      'draw' => intval($request->input('draw')),
      'recordsTotal' => $recordsTotal,
      'recordsFiltered' => $recordsFiltered,
      'data' => AssetDTO::collection($assets),
    ];
  }

  public function findById(int $id): Asset
  {
    return Asset::findOrFail($id);
  }

  public function deleteById(int $id): bool
  {
    return Asset::destroy($id) > 0;
  }

  public function store(Asset $asset): void
  {
    $asset->save();
  }

  public function getDataByType(int $id, int $component_id)
  {
    return Asset::where('component_id', $component_id)->get();
  }

  public function reassignAsset(int $componentId, string $assetTag, int $newAssetId): void
  {
    // Step 1: Get old asset
    $old = Asset::where('asset_tag', $assetTag)->where('component_id', $componentId)->firstOrFail(); // fail fast if not found

    // Step 2: Get new asset
    $newAsset = Asset::findOrFail($newAssetId);

    // Step 3: Assign old employee data to new asset
    $newAsset->update([
      'employee_id' => $old->employee_id,
      'employee_name' => $old->employee_name,
      'employee_position' => $old->employee_position,
    ]);

    // Step 4: Clear old asset
    $old->update([
      'employee_id' => null,
      'employee_name' => null,
      'employee_position' => null,
    ]);
  }
}
