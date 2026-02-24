<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Asset\Asset;
use App\Models\Component\Component;

use App\Contracts\Employees\EmployeeApiServiceInterface;

class EmployeeAPIController extends Controller
{
  /**
   * Constructor method to set up session data.
   *
   * This method initializes session variables for view and menu navigation
   * within the Forms > Yearly Development.
   */
  // Property to hold the injected implementation
  protected EmployeeApiServiceInterface $employeeService;

  public function __construct(EmployeeApiServiceInterface $employeeService)
  {
    // Assign the injected service to the controller’s property for later use
    $this->employeeService = $employeeService;
  }

  public function index()
  {
    $employees = $this->employeeService->getForSelect();

    return response()->json([
      'status' => 'success',
      'data' => $employees,
    ]);
  }

  public function employeeDropdown()
  {
    $employees = $this->employeeService->getEmpDropdown();

    return response()->json([
      'status' => 'success',
      'data' => $employees,
    ]);
  }

  public function employeeFiltered(Component $component)
  {
    $employees = $this->employeeService->getForSelect();

    // ✅ IF MONITOR
    if ($component->asset_tag === 'ESCC-Monitor') {
      // Count monitors per employee
      $monitorCountByEmployee = Asset::where('component_id', $component->id)->selectRaw('employee_id, COUNT(*) as total')->groupBy('employee_id')->pluck('total', 'employee_id');

      $availableEmployees = array_values(
        array_filter($employees, function ($employee) use ($monitorCountByEmployee) {
          $count = $monitorCountByEmployee[$employee['id']] ?? 0;
          return $count < 2; // max 2 monitors
        }),
      );
    }
    // ✅ IF NOT MONITOR
    else {
      // All employee_ids that already exist in assets
      $existingEmployeeIds = Asset::where('component_id', $component->id)->pluck('employee_id')->toArray();

      $availableEmployees = array_values(
        array_filter($employees, function ($employee) use ($existingEmployeeIds) {
          return !in_array($employee['id'], $existingEmployeeIds, true);
        }),
      );
    }

    return response()->json([
      'status' => 'success',
      'data' => $availableEmployees,
    ]);
  }
}
