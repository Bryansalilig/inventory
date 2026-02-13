<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
