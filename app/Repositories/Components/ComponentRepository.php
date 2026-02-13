<?php

namespace App\Repositories\Components;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Contracts\Components\ComponentRepositoryInterface;
use App\Models\Component\Component;
use App\DTOs\Components\ComponentDTO;
use App\DTOs\Components\StoreComponentDTO;

class ComponentRepository implements ComponentRepositoryInterface
{
  /**
   * @return Collection<ComponentDTO>
   */
  public function getAllComponent(Request $request): array
  {
    $columns = ['id', 'name', 'asset_tag'];

    $length = $request->input('length', 10);
    $start = $request->input('start', 0);
    $orderCol = $columns[$request->input('order.0.column', 0)] ?? 'id';
    $orderDir = $request->input('order.0.dir', 'desc');
    $search = $request->input('search.value');

    $query = Component::query();

    if ($search) {
      $query->where(fn($q) => $q->where('name', 'like', "%{$search}%")->orWhere('asset_tag', 'like', "%{$search}%"));
    }

    $recordsFiltered = $query->count();
    $recordsTotal = Component::count();

    $components = $query->orderBy($orderCol, $orderDir)->skip($start)->take($length)->get();

    return [
      'draw' => intval($request->input('draw')),
      'recordsTotal' => $recordsTotal,
      'recordsFiltered' => $recordsFiltered,
      'data' => ComponentDTO::collection($components),
    ];
  }

  /**
   * Store a component in the database
   */
  public function store(StoreComponentDTO $dto): void
  {
    $path = null;

    // Check if picture exists
    if ($dto->picture) {
      // Extra safety: check allowed extensions
      $allowed = ['jpg', 'jpeg', 'png'];

      if (in_array(strtolower($dto->picture->extension()), $allowed)) {
        // Store the file in 'components' folder on public disk
        $path = $dto->picture->store('components', 'public');
      } else {
        // Optional: throw exception if invalid
        throw new \InvalidArgumentException('Invalid picture format. Only jpg, jpeg, png allowed.');
      }
    }

    // Store in DB
    Component::create([
      'name' => $dto->name,
      'asset_tag' => $dto->asset_tag,
      'picture' => $path, // store relative path
    ]);
  }

  public function findOrFail(int $id): Component
  {
    return Component::findOrFail($id);
  }

  public function save(Component $component): void
  {
    $component->save();
  }
}
