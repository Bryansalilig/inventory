<?php
namespace App\DTOs\Employees;

class EmployeeAPIDTO
{
  public function __construct(public int $id, public string $fullname, public ?string $email, public ?string $position) {}
}
