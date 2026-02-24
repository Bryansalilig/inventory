<?php
namespace App\DTOs\Assets;

use App\Models\Asset\Asset;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class AssetDropdownDTO
{
  public function __construct(public int $id, public ?string $asset_tag, public ?string $employee_name) {}

  public static function fromModel(Asset $asset): self
  {
    return new self(id: $asset->id, asset_tag: $asset->asset_tag, employee_name: $asset->employee_name);
  }

  public static function collection(Collection $assets): array
  {
    return $assets->map(fn(Asset $asset) => self::fromModel($asset)->toArray())->toArray();
  }

  public function toArray(): array
  {
    return [
      'id' => $this->id,
      'asset_tag' => $this->asset_tag,
      'employee_name' => $this->employee_name,
    ];
  }
}

/**
 * Create a DTO from a Request object (used for storing/updating).
 * Ginagawa silang plain, strongly-typed DTO (object)
 * Ibinabalik ang JobDTO object na handang gamitin ng Service layer o repository
 */
