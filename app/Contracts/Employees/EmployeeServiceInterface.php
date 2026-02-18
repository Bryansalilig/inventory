<?php
namespace App\Contracts\Employees;

use App\Models\Employee\Employee;

interface EmployeeServiceInterface
{
  /**
   * Get employees for DataTables
   */
  public function getAllEmployee(array $filters): array;
}
