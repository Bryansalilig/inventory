<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Contracts\Employees\EmployeeServiceInterface;

class EmployeeController extends Controller
{
  /**
   * Constructor method to set up session data.
   *
   * This method initializes session variables for view and menu navigation
   */
  // Property to hold the injected implementation
  public function __construct(protected EmployeeServiceInterface $employeeService) {}

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
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
