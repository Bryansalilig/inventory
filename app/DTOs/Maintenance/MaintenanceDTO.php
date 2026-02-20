<?php
namespace App\DTOs\Maintenance;

use App\Models\Maintenance\Maintenance;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

use App\Domain\Maintenance\Enums\MaintenanceStatus;

class MaintenanceDTO
{
  public function __construct(public int $id, public ?string $picture, public string $name, public string $asset_tag, public string $description, public string $model_type, public string $action, public string $status) {}

  public static function fromModel(Maintenance $maintenance): self
  {
    $statusBadge = match ($maintenance->status) {
      MaintenanceStatus::Maintenance => '<span class="badge bg-warning">Maintenance</span>',
      MaintenanceStatus::Disposal => '<span class="badge bg-danger">Disposal</span>',
      MaintenanceStatus::Repaired => '<span class="badge bg-success">Repaired</span>',
    };

    return new self(
      id: $maintenance->id,
      picture: $maintenance->component->picture ? Storage::url($maintenance->component->picture) : null,
      name: $maintenance->component->name,
      asset_tag: $maintenance->asset_tag,
      description: $maintenance->description,
      model_type: $maintenance->stock->model_type,
      action: $maintenance->action,
      status: $statusBadge,
    );
  }

  public static function collection(Collection $maintenances): array
  {
    return $maintenances->map(fn(Maintenance $m) => (array) self::fromModel($m))->toArray();
  }
}

/**
 * Create a DTO from a Request object (used for storing/updating).
 * Ginagawa silang plain, strongly-typed DTO (object)
 * Ibinabalik ang JobDTO object na handang gamitin ng Service layer o repository
 */
