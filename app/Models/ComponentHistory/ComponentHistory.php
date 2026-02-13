<?php

namespace App\Models\ComponentHistory;

use Illuminate\Database\Eloquent\Model;

use App\Models\Component\Component;

class ComponentHistory extends Model
{
  protected $fillable = ['component_id', 'employee_id', 'employee_name', 'employee_position', 'quantity'];

  // Factory method for creating asset from component
  public static function fromComponent(Component $component, int $employeeId, string $employeeName, string $employeePosition, int $quantity): self
  {
    return new self([
      'component_id' => $component->id,
      'employee_id' => $employeeId,
      'employee_name' => $employeeName,
      'employee_position' => $employeePosition,
      'checkout_date' => $checkoutDate,
      'quantity' => $quantity,
    ]);
  }
}
