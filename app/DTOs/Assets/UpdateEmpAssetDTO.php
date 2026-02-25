<?php

namespace App\DTOs\Assets;

class UpdateEmpAssetDTO
{
  public function __construct(public readonly int $id, public readonly int $employeeId, public readonly string $employeeName, public readonly string $employeePosition) {}

  public static function fromArray(array $data): self
  {
    return new self(id: (int) $data['id'], employeeId: (int) $data['employee'], employeeName: (string) $data['employee_name'], employeePosition: (string) $data['employee_position']);
  }

  public function toArray(): array
  {
    return [
      'id' => $this->id,
      'employee_id' => $this->employeeId,
      'employee_name' => $this->employeeName,
      'employee_position' => $this->employeePosition,
    ];
  }
}
