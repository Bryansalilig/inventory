<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Model;

use App\Models\Component\Component;
use App\Models\ComponentStock\ComponentStock;

class Log extends Model
{
  protected $fillable = ['component_id', 'component_stock_id', 'created_by', 'asset_tag', 'employee_name', 'action'];

  public function component()
  {
    return $this->belongsTo(Component::class, 'component_id');
  }

  public function stock()
  {
    return $this->belongsTo(ComponentStock::class, 'component_stock_id');
  }
}
