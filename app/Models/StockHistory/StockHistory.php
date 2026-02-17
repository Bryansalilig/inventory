<?php

namespace App\Models\StockHistory;

use Illuminate\Database\Eloquent\Model;

use App\Models\ComponentStock\ComponentStock;

class StockHistory extends Model
{
  protected $fillable = ['component_id', 'component_stock_id', 'user_id', 'asset_tag', 'employee_id', 'employee_name', 'employee_position', 'quantity'];

  // Factory method for creating asset from component
  public static function checkout(ComponentStock $componentStock, int $component_id, int $user_id, string $asset_tag, int $employee_id, string $employee_name, int $quantity): self
  {
    return new self([
      'component_stock_id' => $componentStock->id,
      'component_id' => $component_id,
      'user_id' => $user_id,
      'asset_tag' => $asset_tag,
      'employee_id' => $employee_id,
      'employee_name' => $employee_name,
      'quantity' => $quantity,
    ]);
  }

  public function getActionAttribute()
  {
    $id = $this->id;
    $model_type = $this->model_type;
    $available_component = $this->available_component;

    $detailUrl = '';
    $editUrl = route('components.edit', $id);

    return '
    <div class="btn-group">
        <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
            data-toggle="dropdown">
            <i class="fa fa-ellipsis-h"></i>
        </button>

        <div class="dropdown-menu actionmenu">
            <a class="dropdown-item btn-checkout" href="#"
                data-id="' .
      $id .
      '" data-model-type="' .
      $model_type .
      '"
        data-available-component="' .
      $available_component .
      '"
                data-toggle="modal" data-target="#checkoutModal">
                <i class="fa fa-check"></i> Check out
            </a>

            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="' .
      $detailUrl .
      '">
                <i class="fa fa-file-text"></i> Detail
            </a>

            <a class="dropdown-item" href="' .
      $editUrl .
      '">
                <i class="fa fa-pencil"></i> Edit
            </a>

            <a class="dropdown-item text-danger btn-delete" href="#"
                data-id="' .
      $id .
      '"
                data-toggle="modal" data-target="#deleteModal">
                <i class="fa fa-trash"></i> Delete
            </a>
        </div>
    </div>';
  }
}
