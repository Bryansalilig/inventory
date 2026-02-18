<?php
namespace App\Contracts\Employees;

use App\Models\Employee\Employee;

interface EmployeeRepositoryInterface
{
  public function getAllEmployee(array $filters): array;

  public function store(Employee $employee): Employee;
}
