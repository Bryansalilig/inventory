<?php
namespace App\Contracts\Employees;

use App\Models\Employee\Employee;

use App\DTOs\Employees\UpdateEmployeeDTO;

interface EmployeeServiceInterface
{
  /**
   * Get employees for DataTables
   */
  public function getAllEmployee(array $filters): array;

  public function assignEmployee(UpdateEmployeeDTO $dto): void;
}
