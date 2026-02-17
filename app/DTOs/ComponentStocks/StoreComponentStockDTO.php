<?php
namespace App\DTOs\ComponentStocks;

class StoreComponentStockDTO
{
  public function __construct(
    public int $component_id,
    public string $model_type,
    public float $cost,
    public int $quantity,
    public string $supplier,
    public ?string $specification,
    public string $purchase_date,
  ) {}

  public static function fromRequest(array $data): self
  {
    return new self(
      component_id: (int) $data['component_id'],
      model_type: $data['model_type'],
      cost: (float) $data['cost'],
      quantity: (int) $data['quantity'],
      supplier: $data['supplier'],
      specification: $data['specification'] ?? null,
      purchase_date: $data['purchase_date'],
    );
  }
}
