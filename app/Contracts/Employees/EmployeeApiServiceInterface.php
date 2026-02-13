<?php
namespace App\Contracts\Employees;

interface EmployeeApiServiceInterface
{
  /**
   * Get all employees from external API
   */
  public function getAll(): array;

  /**
   * Get employees formatted for dropdowns / UI
   */
  public function getForSelect(): array;
}
