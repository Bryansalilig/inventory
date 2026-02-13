<?php

namespace App\Repositories\ComponentStocks;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Contracts\ComponentStocks\ComponentStockRepositoryInterface;
use App\Models\ComponentStock\ComponentStock;
use App\DTOs\ComponentStocks\ComponentStockDTO;
use App\DTOs\Components\StoreComponentDTO;

class ComponentStockRepository implements ComponentStockRepositoryInterface
{
  /**
   * @return Collection<ComponentStockDTO>
   */
  public function getAllComponentStock(Request $request): array
  {
    $columns = ['id', 'model_type', 'cost', 'quantity', 'available_component', 'specification', 'supplier', 'purchase_date'];

    $length = $request->input('length', 10);
    $start = $request->input('start', 0);
    $orderCol = $columns[$request->input('order.0.column', 0)] ?? 'id';
    $orderDir = $request->input('order.0.dir', 'desc');
    $search = $request->input('search.value');

    $query = ComponentStock::query();

    if ($search) {
      $query->where(
        fn($q) => $q
          ->where('name', 'like', "%{$search}%")
          ->orWhere('model_type', 'like', "%{$search}%")
          ->orWhere('specification', 'like', "%{$search}%"),
      );
    }

    $recordsFiltered = $query->count();
    $recordsTotal = ComponentStock::count();

    $cstocks = $query->orderBy($orderCol, $orderDir)->skip($start)->take($length)->get();

    return [
      'draw' => intval($request->input('draw')),
      'recordsTotal' => $recordsTotal,
      'recordsFiltered' => $recordsFiltered,
      'data' => ComponentStockDTO::collection($cstocks),
    ];
  }

  /**
   * Store a component in the database
   */
  // public function store(StoreComponentDTO $dto): void
  // {
  //   $path = null;

  //   // Check if picture exists
  //   if ($dto->picture) {
  //     // Extra safety: check allowed extensions
  //     $allowed = ['jpg', 'jpeg', 'png'];

  //     if (in_array(strtolower($dto->picture->extension()), $allowed)) {
  //       // Store the file in 'components' folder on public disk
  //       $path = $dto->picture->store('components', 'public');
  //     } else {
  //       // Optional: throw exception if invalid
  //       throw new \InvalidArgumentException('Invalid picture format. Only jpg, jpeg, png allowed.');
  //     }
  //   }

  //   // Store in DB
  //   Component::create([
  //     'name' => $dto->name,
  //     'asset_tag' => $dto->asset_tag,
  //     'picture' => $path, // store relative path
  //   ]);
  // }

  public function findOrFail(int $id): Component
  {
    return Component::findOrFail($id);
  }

  public function save(Component $component): void
  {
    $component->save();
  }
}
