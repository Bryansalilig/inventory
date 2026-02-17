<?php
namespace App\DTOs\Components;

use App\Models\Component\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ComponentDTO
{
  public function __construct(public int $id, public ?string $picture, public string $name, public ?string $asset_tag, public int $available_component, public string $action) {}

  public static function fromModel(Component $component): self
  {
    return new self(
      id: $component->id,
      picture: $component->picture ? Storage::url($component->picture) : null,
      name: $component->name,
      asset_tag: $component->asset_tag,
      available_component: (int) ($component->available_component ?? 0),
      action: $component->action,
    );
  }

  public static function collection(Collection $components): array
  {
    return $components->map(fn(Component $c) => (array) self::fromModel($c))->toArray();
  }
}

/**
 * Create a DTO from a Request object (used for storing/updating).
 * Ginagawa silang plain, strongly-typed DTO (object)
 * Ibinabalik ang JobDTO object na handang gamitin ng Service layer o repository
 */
