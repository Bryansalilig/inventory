<?php
namespace App\DTOs\Cubicles;

use App\Models\Cubicle\Cubicle;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

use App\Models\Employee\Employee;

class CubicleDTO
{
  public function __construct(public int $id, public string $name, public int $location, public ?string $status_badge, public ?string $employee_name, public string $action) {}

  public static function fromModel(Cubicle $cubicle): self
  {
    return new self(id: $cubicle->id, name: $cubicle->name, location: $cubicle->location, status_badge: self::getCubicleStatusBadge($cubicle->employee), employee_name: optional($cubicle->employee)?->employee_name, action: $cubicle->action);
  }

  private static function getCubicleStatusBadge(?Employee $employee): string
  {
    return $employee ? '<span class="badge bg-warning">Occupied</span>' : '<span class="badge bg-success text-white">Available</span>';
  }

  public static function collection(Collection $cubicles): array
  {
    return $cubicles->map(fn(Cubicle $c) => (array) self::fromModel($c))->toArray();
  }
}

/**
 * Create a DTO from a Request object (used for storing/updating).
 * Ginagawa silang plain, strongly-typed DTO (object)
 * Ibinabalik ang JobDTO object na handang gamitin ng Service layer o repository
 */
