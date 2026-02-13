<?php
namespace App\DTOs\Components;

use Illuminate\Http\UploadedFile;

class StoreComponentDTO
{
  public function __construct(
    public string $name,
    public string $model_type,
    public ?string $specification,
    public float $cost,
    public int $quantity,
    public string $supplier,
    public string $asset_tag,
    public string $purchase_date,
    public ?string $description,
    public ?UploadedFile $picture,
  ) {}

  public static function fromRequest(array $data): self
  {
    return new self(
      name: $data['name'],
      model_type: $data['model_type'],
      specification: $data['specification'] ?? null,
      cost: (float) $data['cost'],
      quantity: (int) $data['quantity'],
      supplier: $data['supplier'],
      asset_tag: $data['asset_tag'],
      purchase_date: $data['purchase_date'],
      description: $data['description'] ?? null,
      picture: $data['picture'] ?? null,
    );
  }
}
