<?php

namespace App\Repositories\Employees;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Contracts\Employees\EmployeeRepositoryInterface;
use App\Models\Employee\Employee;
use App\Models\Asset\Asset;

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

  public function findById(string $id): Employee
  {
    return Employee::findOrFail($id);
  }

  // Fetch employees for dropdown
  public function getDropdown(): Collection
  {
    return Employee::query()
      ->select('id', 'employee_name') // minimal columns only
      ->orderBy('employee_name')
      ->get();
  }

  public function getExistingEmployeeIds(): array
  {
    return Employee::query()->pluck('employee_id')->toArray();
  }

  public function getEmployeeIdsWithAssignedAssets(int $componentId): array
  {
    return Asset::where('component_id', $componentId)
      ->whereNotNull('employee_id') // prevent null pollution
      ->pluck('employee_id')
      ->all();
  }

  public function assignEmployee(int $id, string $oldEmployeeId, int $newEmployeeId, string $newEmployeeName, string $newEmployeePosition): void
  {
    // 1️⃣ Bulk update assets (NO foreach)
    Asset::where('employee_id', $oldEmployeeId)->update(['employee_id' => $newEmployeeId, 'employee_name' => $newEmployeeName, 'employee_position' => $newEmployeePosition]);

    // 2️⃣ Update employee record
    $employee = Employee::findOrFail($id);

    $employee->update([
      'employee_id' => $newEmployeeId,
      'employee_name' => $newEmployeeName,
    ]);
  }
}
