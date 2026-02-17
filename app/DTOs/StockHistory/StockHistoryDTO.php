<?php
namespace App\DTOs\StockHistory;

use App\Models\StockHistory\StockHistory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class StockHistoryDTO
{
  public function __construct(
    public int $id,
    public string $user_name,
    public string $asset_tag,
    public string $employee_name,
    public string $quantity,
    public string $created_at,
    public string $action,
  ) {}

  public static function fromModel(StockHistory $shistory): self
  {
    return new self(
      id: $shistory->id,
      user_name: 'Bryan Salilig',
      asset_tag: $shistory->asset_tag,
      employee_name: $shistory->employee_name,
      quantity: $shistory->quantity,
      created_at: $shistory->created_at,
      action: $shistory->action,
    );
  }

  public static function collection(Collection $shistory): array
  {
    return $shistory->map(fn(StockHistory $sh) => (array) self::fromModel($sh))->toArray();
  }
}

/**
 * Create a DTO from a Request object (used for storing/updating).
 * Ginagawa silang plain, strongly-typed DTO (object)
 * Ibinabalik ang JobDTO object na handang gamitin ng Service layer o repository
 */
