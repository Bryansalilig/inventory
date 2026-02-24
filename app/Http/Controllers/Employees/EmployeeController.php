<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Contracts\Employees\EmployeeServiceInterface;
use App\Services\Employees\EmployeeEditPageService;

use App\Http\Requests\Employees\UpdateEmployeeRequest;

use App\DTOs\Employees\UpdateEmployeeDTO;

class EmployeeController extends Controller
{
  /**
   * Constructor method to set up session data.
   *
   * This method initializes session variables for view and menu navigation
   */
  // Property to hold the injected implementation
  public function __construct(protected EmployeeServiceInterface $employeeService, private EmployeeEditPageService $editPageService) {}

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('modules.employees.index');
  }

  public function getData(Request $request)
  {
    return response()->json($this->employeeService->getAllEmployee(filters: $request->only(['draw', 'start', 'length', 'order', 'search'])));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $employee = $this->editPageService->getEditData($id);

    return view('modules.employees.edit', [
      'employee' => $employee,
    ]);
  }

  public function data(Request $request)
  {
    $data = $this->editPageService->getDataByType($request->id, $request->component_id);

    return response()->json([
      'status' => 'success',
      'data' => $data,
    ]);
  }

  /**
   * Reassign Employee the specified resource in storage.
   */
  public function updateEmployee(UpdateEmployeeRequest $request)
  {
    $dto = UpdateEmployeeDTO::fromArray($request->validated());

    // echo '<pre>';
    // print_r($dto);
    // return;

    $this->employeeService->assignEmployee($dto);

    return response()->json([
      'message' => 'Employee assgined successfully.',
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request)
  {
    echo '<pre>';
    print_r($request->all());
    return;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
