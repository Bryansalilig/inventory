<?php
namespace App\DTOs\ComponentStocks;

use App\Models\ComponentStock\ComponentStock;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ComponentStockDTO
{
  public function __construct(
    public int $id,
    public ?string $model_type,
    public float $cost,
    public int $quantity,
    public int $available_component,
    public ?string $specification,
    public ?string $supplier,
    public ?string $purchase_date,
    public string $qty_display,
    public string $action,
  ) {}

  public static function fromModel(ComponentStock $cstock): self
  {
    return new self(
      id: $cstock->id,
      model_type: $cstock->model_type,
      cost: (float) number_format($cstock->cost, 2, '.', ''),
      quantity: $cstock->quantity,
      available_cstock: $cstock->available_cstock,
      specification: $cstock->specification,
      supplier: $cstock->supplier,
      purchase_date: optional($cstock->purchase_date)?->format('Y-m-d'),
      qty_display: $cstock->qty_display,
      action: $cstock->action,
    );
  }

  public static function collection(Collection $cstocks): array
  {
    return $cstocks->map(fn(ComponentStock $cs) => (array) self::fromModel($cs))->toArray();
  }
}

/**
 * Create a DTO from a Request object (used for storing/updating).
 * Ginagawa silang plain, strongly-typed DTO (object)
 * Ibinabalik ang JobDTO object na handang gamitin ng Service layer o repository
 */
