<?php

namespace App\Repositories\Employees;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Contracts\Employees\EmployeeRepositoryInterface;
use App\Models\Employee\Employee;
use App\DTOs\Employees\EmployeeDTO;

class EmployeeRepository implements EmployeeRepositoryInterface
{
  /**
   * @return Collection<EmployeeDTO>
   */
  public function getAllEmployee(array $filters): array
  {
    $columns = ['id'];

    $length = $filters['length'] ?? 10;
    $start = $filters['start'] ?? 0;
    $orderCol = $columns[$filters['order'][0]['column'] ?? 0] ?? 'id';
    $orderDir = $filters['order'][0]['dir'] ?? 'desc';
    $search = $filters['search']['value'] ?? null;

    $baseQuery = Employee::query();

    $recordsTotal = (clone $baseQuery)->count();

    if ($search) {
      $baseQuery->where(function ($q) use ($search) {
        $q->where('employee_name', 'like', "%{$search}%");
      });
    }

    $recordsFiltered = (clone $baseQuery)->count();

    $data = $baseQuery->orderBy($orderCol, $orderDir)->skip($start)->take($length)->get();

    return [
      'draw' => (int) ($filters['draw'] ?? 1),
      'recordsTotal' => $recordsTotal,
      'recordsFiltered' => $recordsFiltered,
      'data' => EmployeeDTO::collection($data),
    ];
  }

  public function store(Employee $employee): Employee
  {
    return Employee::firstOrCreate(
      ['employee_id' => $employee->employee_id],
      [
        'cubicle_id' => $employee->cubicle_id,
        'employee_name' => $employee->employee_name,
      ],
    );
  }
}
