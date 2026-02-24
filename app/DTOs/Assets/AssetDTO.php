<?php
namespace App\DTOs\Assets;

use App\Models\Asset\Asset;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class AssetDTO
{
  public function __construct(public int $id, public ?string $picture, public string $name, public ?string $model_type, public ?string $asset_tag, public ?int $employee_id, public ?string $employee_name, public ?string $employee_position, public string $checkout_date, public string $action) {}

  public static function fromModel(Asset $asset): self
  {
    return new self(
      id: $asset->id,
      picture: $asset->component->picture ? Storage::url($asset->component->picture) : null,
      name: $asset->component->name,
      model_type: $asset->stock->model_type,
      asset_tag: $asset->asset_tag,
      employee_id: $asset->employee_id,
      employee_name: $asset->employee_name ?? '-',
      employee_position: $asset->employee_position ?? '-',
      checkout_date: $asset->checkout_date,
      action: $asset->action,
    );
  }

  public static function collection(Collection $assets): array
  {
    return $assets->map(fn(Asset $a) => (array) self::fromModel($a))->toArray();
  }
}

/**
 * Create a DTO from a Request object (used for storing/updating).
 * Ginagawa silang plain, strongly-typed DTO (object)
 * Ibinabalik ang JobDTO object na handang gamitin ng Service layer o repository
 */
