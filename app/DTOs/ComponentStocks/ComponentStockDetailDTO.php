<?php
namespace App\DTOs\ComponentStocks;

use App\Models\ComponentStock\ComponentStock;

class ComponentStockDetailDTO
{
  public function __construct(public int $id, public ?string $model_type, public float $cost, public int $quantity, public int $available_component, public ?string $specification, public ?string $supplier, public ?string $purchase_date, public string $created_at) {}

  /**
   * Create a DTO from a ComponentStock model
   */
  public static function fromModel(ComponentStock $cstock): self
  {
    return new self(
      id: $cstock->id,
      model_type: $cstock->model_type,
      cost: round((float) $cstock->cost, 2), // cleaner than number_format
      quantity: $cstock->quantity,
      available_component: $cstock->available_component,
      specification: $cstock->specification,
      supplier: $cstock->supplier,
      purchase_date: optional($cstock->purchase_date)?->format('Y - F'),
      created_at: $cstock->created_at->format('F d Y'),
    );
  }
}
