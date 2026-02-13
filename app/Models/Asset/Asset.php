<?php

namespace App\Models\Asset;

use Illuminate\Database\Eloquent\Model;

use App\Models\Component\Component;

class Asset extends Model
{
  // Mass assignable fields
  protected $fillable = ['component_id', 'employee_id', 'checkout_date', 'quantity'];

  public function component()
  {
    return $this->belongsTo(Component::class, 'component_id');
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
                data-toggle="modal" data-target="#checkout">
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

  // Factory method for creating asset from component
  public static function fromComponent(Component $component, int $employeeId, string $employeeName, string $employeePosition, string $checkoutDate, int $quantity): self
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
