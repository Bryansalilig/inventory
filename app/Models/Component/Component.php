<?php

namespace App\Models\Component;

use Illuminate\Database\Eloquent\Model;

use App\Models\ComponentStock\ComponentStock;

class Component extends Model
{
  // Mass assignable fields
  protected $fillable = ['picture', 'name', 'asset_tag'];

  /**
   * Accessor for action buttons
   * Returns HTML for Edit/Delete buttons
   */
  public function getActionAttribute()
  {
    $component = $this->id;
    $name = $this->name;

    $detailUrl = route('components.stocks.index', $component);
    $editUrl = route('components.edit', $component);

    return '
    <div class="btn-group">
        <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
            data-toggle="dropdown">
            <i class="fa fa-ellipsis-h"></i>
        </button>

        <div class="dropdown-menu actionmenu">
        <a class="dropdown-item" href="' .
      $detailUrl .
      '">
                  <i class="fa fa-file-text"></i> Stocks
              </a>

            <div class="dropdown-divider"></div>


            <a class="dropdown-item" href="' .
      $editUrl .
      '">
                <i class="fa fa-pencil"></i> Edit
            </a>

            <a class="dropdown-item text-danger btn-delete" href="#"
                data-id="' .
      $component .
      '"
                data-toggle="modal" data-target="#deleteModal">
                <i class="fa fa-trash"></i> Delete
            </a>
        </div>
    </div>';
  }

  public function stocks()
  {
    return $this->hasMany(ComponentStock::class);
  }
}
