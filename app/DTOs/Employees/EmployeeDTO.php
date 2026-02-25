<?php

namespace App\DTOs\Employees;

use App\Models\Employee\Employee;
use App\Models\Cubicle\Cubicle; // ✅ added
use Illuminate\Support\Collection;

class EmployeeDTO
{
  public function __construct(
    public int $id,
    public ?int $cubicle_id,
    public ?int $cubicleLocation,
    public ?string $cubicle_name,
    public string $employee_name,
    public ?string $cpu_tag,
    public ?string $keyboard_tag,
    public ?string $mouse_tag,
    public ?string $headset_tag,
    public array $monitor_tags,
    public ?string $camera_tag,
    public string $action,
  ) {}

  public static function fromModel(Employee $employee): self
  {
    $cubicle = $employee->cubicle;

    return new self(
      id: $employee->id,
      cubicle_id: $employee->cubicle_id,
      cubicleLocation: $cubicle?->location, // ✅ fixed name
      cubicle_name: self::formatCubicle($cubicle),
      employee_name: $employee->employee_name,
      cpu_tag: $employee->cpu?->asset_tag,
      keyboard_tag: $employee->keyboard?->asset_tag,
      mouse_tag: $employee->mouse?->asset_tag,
      headset_tag: $employee->headset?->asset_tag,
      monitor_tags: $employee->monitors->pluck('asset_tag')->values()->toArray(),
      camera_tag: $employee->camera?->asset_tag,
      action: $employee->action,
    );
  }

  private static function formatCubicle(?Cubicle $cubicle): ?string
  {
    if (!$cubicle) {
      return null; // ✅ aligned with ?string
    }

    return $cubicle->name . ' - ' . self::mapLocation($cubicle->location);
  }

  private static function mapLocation(?int $cubicleLocation): string
  {
    return match ($cubicleLocation) {
      1 => 'HR Floor',
      2 => '2nd Floor',
      3 => '3rd Floor',
      4 => '4th Floor',
      default => '5th Floor',
    };
  }

  public static function collection(Collection $employees): array
  {
    return $employees->map(fn(Employee $e) => (array) self::fromModel($e))->toArray();
  }
}
