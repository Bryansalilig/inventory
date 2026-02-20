<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Domain\Maintenance\Enums\MaintenanceStatus;

use App\Contracts\Maintenance\MaintenanceServiceInterface;

use App\DTOs\Maintenance\StoreMaintenanceDTO;

use App\Http\Requests\Maintenance\StoreMaintenanceRequest;

class MaintenanceController extends Controller
{
  /**
   * Constructor method to set up session data.
   *
   * This method initializes session variables for view and menu navigation
   * within the Forms > Yearly Development.
   */
  // Property to hold the injected implementation
  public function __construct(protected MaintenanceServiceInterface $maintenanceService) {}

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('modules.maintenance.index');
  }

  public function getData($status, Request $request)
  {
    $enumStatus = MaintenanceStatus::from($status);

    return response()->json($this->maintenanceService->getAllMaintenance(status: $enumStatus, filters: $request->only(['draw', 'start', 'length', 'order', 'search'])));
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
  public function store(StoreMaintenanceRequest $request)
  {
    $validated = $request->validated();
    $dto = new StoreMaintenanceDTO(id: $validated['id'], componentId: $validated['component_id'], componentStockId: $validated['component_stock_id'], employeeId: $validated['employee_id'], description: $validated['description'], assetTag: $validated['asset_tag']);

    $this->maintenanceService->storeFromAsset($dto, 1);

    return response()->json(['message' => 'Asset moved to maintenance']);
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
