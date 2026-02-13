<?php

namespace App\Models\ComponentStock;

use Illuminate\Database\Eloquent\Model;

class ComponentStock extends Model
{
  // Mass assignable fields
  protected $fillable = ['model_type', 'cost', 'quantity', 'available_component', 'specification', 'supplier', 'purchase_date'];

  // Casts
  protected $casts = [
    'purchase_date' => 'date',
    'cost' => 'decimal:2',
    'quantity' => 'integer',
    'available_component' => 'integer',
  ];

  // Check if the component is available
  public function isAvailable(): bool
  {
    return $this->available_component > 0;
  }

  // Decrease stock by checkout qty
  public function subtractComponent(int $checkout_qty): void
  {
    if ($checkout_qty > $this->available_component) {
      throw new DomainException('Cannot checkout more than available stock.');
    }

    $this->available_component -= $checkout_qty;
  }

  /**
   * Accessor for action buttons
   * Returns HTML for Edit/Delete buttons
   */
  public function getActionAttribute()
  {
    $id = $this->id;
    $name = $this->name;

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
      '" data-name="' .
      $name .
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

  public function getQtyDisplayAttribute()
  {
    return $this->quantity . ' / ' . $this->available_component;
  }
}
