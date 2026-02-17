<?php

namespace App\Models\ComponentHistory;

use Illuminate\Database\Eloquent\Model;

use App\Models\Component\Component;

class ComponentHistory extends Model
{
  protected $fillable = ['component_id', 'component_stock_id', 'user_id', 'asset_tag', 'employee_id', 'employee_name', 'employee_position', 'quantity'];

  // Factory method for creating asset from component
  public static function fromComponent(Component $component, int $componentStockId, int $userId, sting $assetTag, int $employeeId, string $employeeName, int $quantity): self
  {
    return new self([
      'component_id' => $component->id,
      'component_stock_id' => $componentStockId,
      'user_id' => 1,
      'asset_tag' => $assetTag,
      'employee_id' => $employeeId,
      'employee_name' => $employeeName,
      'quantity' => $quantity,
    ]);
  }
}
