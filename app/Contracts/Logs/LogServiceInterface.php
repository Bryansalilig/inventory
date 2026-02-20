<?php

namespace App\Contracts\Logs;

use Illuminate\Http\Request;

interface LogServiceInterface
{
  /**
   * Get component stocks for DataTables
   */
  public function getAllLog(array $filters): array;
}
