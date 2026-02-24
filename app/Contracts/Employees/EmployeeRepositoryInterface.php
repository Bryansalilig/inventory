<?php
namespace App\Contracts\Employees;

use Illuminate\Support\Collection;
use App\Models\Employee\Employee;

interface EmployeeRepositoryInterface
{
  public function getAllEmployee(array $filters): array;

  public function store(Employee $employee): Employee;

  public function findById(string $id): Employee;

  public function getDropdown(): Collection;

  public function assignEmployee(int $id, string $oldEmployeeId, int $newEmployeeId, string $newEmployeeName, string $newEmployeePosition): void;
}
