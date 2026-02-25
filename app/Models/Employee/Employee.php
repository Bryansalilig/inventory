<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Model;

use App\Models\Cubicle\Cubicle;
use App\Models\Asset\Asset;

class Employee extends Model
{
  protected $fillable = ['id', 'employee_id', 'cubicle_id', 'employee_name'];

  public function cubicle()
  {
    return $this->belongsTo(Cubicle::class, 'cubicle_id');
  }

  public function cpu()
  {
    return $this->hasOne(Asset::class, 'employee_id', 'employee_id')->where('component_id', '8');
  }

  public function keyboard()
  {
    return $this->hasOne(Asset::class, 'employee_id', 'employee_id')->where('component_id', '4');
  }

  public function mouse()
  {
    return $this->hasOne(Asset::class, 'employee_id', 'employee_id')->where('component_id', '7');
  }

  public function headset()
  {
    return $this->hasOne(Asset::class, 'employee_id', 'employee_id')->where('component_id', '5');
  }

  public function monitors()
  {
    return $this->hasMany(Asset::class, 'employee_id', 'employee_id')->where('component_id', '3');
  }

  public function camera()
  {
    return $this->hasOne(Asset::class, 'employee_id', 'employee_id')->where('component_id', '9');
  }

  public function ups()
  {
    return $this->hasOne(Asset::class, 'employee_id', 'employee_id')->where('component_id', '6');
  }

  // Factory method for creating asset from component
  public static function storeEmployee(int $employee_id, ?string $cubicle_id, string $employee_name): self
  {
    return new self([
      'employee_id' => $employee_id,
      'cubicle_id' => $cubicle_id,
      'employee_name' => $employee_name,
    ]);
  }

  /**
   * Accessor for action buttons
   * Returns HTML for Edit/Delete buttons
   */
  public function getActionAttribute()
  {
    $id = $this->id;
    $employee_id = $this->employee_id;
    $employee_name = $this->employee_name;

    $detailUrl = '';
    $editUrl = route('employees.edit', $id);

    return '
    <div class="btn-group">
        <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
            data-toggle="dropdown">
            <i class="fa fa-ellipsis-h"></i>
        </button>

        <div class="dropdown-menu actionmenu">
            <a class="dropdown-item btn-employee" href="#"
                data-id="' .
      $id .
      '"
                data-employee-id="' .
      $employee_id .
      '"
      data-employee-name="' .
      $employee_name .
      '"
                data-toggle="modal" data-target="#employeeModal">
                <i class="fa fa-user"></i> Employee
            </a>
            <a class="dropdown-item btn-cubicle" href="#"
                data-id="' .
      $id .
      '"
                data-employee-name="' .
      $employee_name .
      '"
                data-toggle="modal" data-target="#cubicleModal">
                <i class="fa fa-exchange"></i> Cubicle
            </a>

            <div class="dropdown-divider"></div>

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
                <i class="fa fa-trash"></i> Deactivate
            </a>
        </div>
    </div>';
  }
}
