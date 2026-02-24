<?php
namespace App\DTOs\Employees;

use App\Models\Employee\Employee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class EmployeeEditDTO
{
  public function __construct(
    public int $id,
    public int $employee_id,
    public ?int $cubicle_id,
    public ?string $cubicle_name,
    public string $employee_name,
    public ?string $cpu_tag,
    public ?int $cpu_component_id,
    public ?string $keyboard_tag,
    public ?int $keyboard_component_id,
    public ?string $mouse_tag,
    public ?int $mouse_component_id,
    public ?string $headset_tag,
    public ?int $headset_component_id,
    public array $monitor_tags,
    public ?int $monitor_component_id,
    public ?string $camera_tag,
    public ?int $camera_component_id,
    public ?string $ups_tag,
    public ?int $ups_component_id,
  ) {}

  public static function fromModel(Employee $employee): self
  {
    return new self(
      id: $employee->id,
      employee_id: $employee->employee_id,
      cubicle_id: $employee->cubicle_id,
      cubicle_name: optional($employee->cubicle)?->name ?? '-',
      employee_name: $employee->employee_name,
      cpu_tag: optional($employee->cpu)?->asset_tag ?? '-',
      cpu_component_id: optional($employee->cpu)?->component_id ?? 0,
      keyboard_tag: optional($employee->keyboard)?->asset_tag ?? '-',
      keyboard_component_id: optional($employee->keyboard)?->component_id ?? 0,
      mouse_tag: optional($employee->mouse)?->asset_tag ?? '-',
      mouse_component_id: optional($employee->mouse)?->component_id ?? 0,
      headset_tag: optional($employee->headset)?->asset_tag ?? '-',
      headset_component_id: optional($employee->headset)?->component_id ?? 0,
      monitor_tags: $employee->monitors->pluck('asset_tag')->values()->toArray() ?? '-',
      monitor_component_id: $employee->monitors->first()?->component_id ?? 0,
      camera_tag: optional($employee->camera)?->asset_tag ?? '-',
      camera_component_id: optional($employee->camera)?->component_id ?? 0,
      ups_tag: optional($employee->ups)?->asset_tag ?? '-',
      ups_component_id: optional($employee->ups)?->component_id ?? 0,
    );
  }

  public static function collection(Collection $employees): array
  {
    return $employees->map(fn(Employee $e) => (array) self::fromModel($e))->toArray();
  }
}

/**
 * Create a DTO from a Request object (used for storing/updating).
 * Ginagawa silang plain, strongly-typed DTO (object)
 * Ibinabalik ang JobDTO object na handang gamitin ng Service layer o repository
 */
