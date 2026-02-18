<?php
namespace App\DTOs\Employees;

use App\Models\Employee\Employee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class EmployeeDTO
{
  public function __construct(
    public int $id,
    public ?int $cubicle_id,
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
    return new self(
      id: $employee->id,
      cubicle_id: $employee->cubicle_id,
      cubicle_name: optional($employee->cubicle)?->name,
      employee_name: $employee->employee_name,
      cpu_tag: optional($employee->cpu)?->asset_tag,
      keyboard_tag: optional($employee->keyboard)?->asset_tag,
      mouse_tag: optional($employee->mouse)?->asset_tag,
      headset_tag: optional($employee->headset)?->asset_tag,
      monitor_tags: $employee->monitors->pluck('asset_tag')->values()->toArray(),
      camera_tag: optional($employee->camera)?->asset_tag,
      action: $employee->action,
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
