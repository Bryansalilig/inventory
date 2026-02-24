<?php

namespace App\DTOs\Employees;

class UpdateEmployeeDTO
{
  public function __construct(public readonly int $id, public readonly int $oldEmployeeId, public readonly int $newEmployeeId, public readonly string $newEmployeeName, public readonly string $newEmployeePosition) {}

  public static function fromArray(array $data): self
  {
    return new self(id: (int) $data['id'], oldEmployeeId: (int) $data['employee_id'], newEmployeeId: (int) $data['employee'], newEmployeeName: (string) $data['new_employee_name'], newEmployeePosition: (string) $data['new_employee_position']);
  }

  public function toArray(): array
  {
    return [
      'id' => $this->id,
      'employee_id' => $this->employeeId,
      'employee' => $this->oldEmployeeId,
      'new_employee_name' => $this->newEmployeeName,
      'new_employee_position' => $this->newEmployeePosition,
    ];
  }
}
