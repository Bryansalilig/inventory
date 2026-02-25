<?php

namespace App\Models\Asset;

use Illuminate\Database\Eloquent\Model;

use App\Models\Component\Component;
use App\Models\ComponentStock\ComponentStock;

class Asset extends Model
{
  // Mass assignable fields
  protected $fillable = ['component_stock_id', 'component_id', 'employee_id', 'asset_tag', 'employee_name', 'employee_position', 'checkout_date', 'quantity'];

  public function component()
  {
    return $this->belongsTo(Component::class, 'component_id');
  }

  public function stock()
  {
    return $this->belongsTo(ComponentStock::class, 'component_stock_id');
  }

  /**
   * Accessor for action buttons
   * Returns HTML for Edit/Delete buttons
   */
  public function getActionAttribute()
  {
    $id = $this->id;
    $component_id = $this->component->id;
    $component_stock_id = $this->stock->id;
    $employee_id = $this->employee_id;
    $asset_tag = $this->asset_tag;
    $employee_name = $this->employee_name;
    $status = $this->status;
    $name = $this->component->name;
    $model_type = $this->stock->model_type;

    $detailUrl = '';
    $editUrl = route('components.edit', $id);

    $assignButton = '';

    if (empty($employee_id)) {
      $assignButton =
        '
        <a class="dropdown-item btn-assign" href="#"
            data-id="' .
        $id .
        '"
            data-component-id="' .
        $component_id .
        '"
            data-name="' .
        $name .
        '"
            data-asset-tag="' .
        $asset_tag .
        '"
            data-model-type="' .
        $model_type .
        '"
            data-toggle="modal" data-target="#assignModal">
            <i class="fa fa-exchange"></i> Assign
        </a>
    ';
    }

    return '
<div class="btn-group">
    <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
        data-toggle="dropdown">
        <i class="fa fa-ellipsis-h"></i>
    </button>

    <div class="dropdown-menu actionmenu">
        ' .
      $assignButton .
      '

        <a class="dropdown-item btn-maintenance" href="#"
            data-id="' .
      $id .
      '"
            data-component-id="' .
      $component_id .
      '"
            data-component-stock-id="' .
      $component_stock_id .
      '"
            data-employee-id="' .
      $employee_id .
      '"
            data-asset-tag="' .
      $asset_tag .
      '"
            data-employee-name="' .
      $employee_name .
      '"
            data-status="' .
      $status .
      '"
            data-name="' .
      $name .
      '"
            data-model-type="' .
      $model_type .
      '"
            data-toggle="modal" data-target="#maintenanceModal">
            <i class="fa fa-wrench"></i> Maintenance
        </a>
    </div>
</div>';
  }

  // Factory method for creating asset from component
  public static function fromComponent(ComponentStock $componentStock, int $component_id, int $employeeId, string $asset_tag, string $employeeName, string $employeePosition, string $checkoutDate, int $quantity): self
  {
    return new self([
      'component_stock_id' => $componentStock->id,
      'component_id' => $component_id,
      'asset_tag' => $asset_tag,
      'employee_id' => $employeeId,
      'employee_name' => $employeeName,
      'employee_position' => $employeePosition,
      'checkout_date' => $checkoutDate,
      'quantity' => $quantity,
    ]);
  }
}
