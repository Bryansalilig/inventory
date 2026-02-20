<?php

namespace App\Models\Maintenance;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Maintenance\Enums\MaintenanceStatus;

use App\Models\Component\Component;
use App\Models\ComponentStock\ComponentStock;

class Maintenance extends Model
{
  protected $fillable = ['component_id', 'component_stock_id', 'employee_id', 'asset_tag', 'employee_name', 'description', 'status'];

  protected $casts = [
    'status' => MaintenanceStatus::class,
  ];

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
