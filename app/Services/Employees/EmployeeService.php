<?php

namespace App\Services\Employees;

use Illuminate\Support\Facades\DB;
use App\Exceptions\ComponentNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Contracts\Employees\EmployeeServiceInterface;
use App\Contracts\Employees\EmployeeRepositoryInterface;

use App\DTOs\Employees\UpdateEmployeeDTO;

class EmployeeService implements EmployeeServiceInterface
{
  public function __construct(protected EmployeeRepositoryInterface $employeeRepository) {}

  public function getAllEmployee(array $filters): array
  {
    return $this->employeeRepository->getAllEmployee(filters: $filters);
  }

  public function assignEmployee(UpdateEmployeeDTO $dto): void
  {
    DB::transaction(function () use ($dto) {
      $this->employeeRepository->assignEmployee(id: $dto->id, oldEmployeeId: $dto->oldEmployeeId, newEmployeeId: $dto->newEmployeeId, newEmployeeName: $dto->newEmployeeName, newEmployeePosition: $dto->newEmployeePosition);
    });
  }
}
