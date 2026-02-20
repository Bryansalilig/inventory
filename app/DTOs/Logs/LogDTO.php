<?php
namespace App\DTOs\Logs;

use App\Models\Log\Log;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class LogDTO
{
  public function __construct(public int $id, public string $picture, public string $name, public string $model_type, public string $asset_tag, public string $assigned_by, public string $action, public string $created_by, public string $created_at) {}

  public static function fromModel(Log $log): self
  {
    return new self(
      id: $log->id,
      picture: $log->component->picture ? Storage::url($log->component->picture) : null,
      name: $log->component->name,
      model_type: $log->stock->model_type,
      asset_tag: $log->asset_tag,
      assigned_by: $log->employee_name,
      action: $log->action,
      created_by: $log->created_by,
      created_at: $log->created_at->format('Y-m-d'),
    );
  }

  public static function collection(Collection $logs): array
  {
    return $logs->map(fn(Log $l) => (array) self::fromModel($l))->toArray();
  }
}

/**
 * Create a DTO from a Request object (used for storing/updating).
 * Ginagawa silang plain, strongly-typed DTO (object)
 * Ibinabalik ang JobDTO object na handang gamitin ng Service layer o repository
 */
