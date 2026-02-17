<?php

namespace App\Http\Controllers\ComponentStocks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Component\Component;

use App\Contracts\ComponentStocks\ComponentStockServiceInterface;
use App\Contracts\ComponentStocks\ComponentStockCheckoutServiceInterface;
use App\Contracts\StockHistory\StockHistoryServiceInterface;

use App\DTOs\ComponentStocks\StoreComponentStockDTO;

use App\Models\ComponentStock\ComponentStock;

use App\Http\Requests\ComponentStocks\StoreComponentStockRequest;
use App\Http\Requests\ComponentStocks\CheckoutRequest;

class ComponentStockController extends Controller
{
  /**
   * Constructor method to set up session data.
   *
   * This method initializes session variables for view and menu navigation
   * within the Forms > Yearly Development.
   */
  // Property to hold the injected implementation
  public function __construct(protected ComponentStockServiceInterface $componentStockService, protected ComponentStockCheckoutServiceInterface $componentStockCheckoutService, protected StockHistoryServiceInterface $stockHistoryService) {}

  /**
   * Display a listing of the resource.
   */

  public function index(Component $component)
  {
    $assetTag = $this->componentStockService->generateUniqueAssetTag($component->asset_tag);

    return view('modules.components.stocks.index', [
      'component' => $component,
      'assetTag' => $assetTag,
    ]);
  }

  public function getData(Component $component, Request $request)
  {
    return response()->json($this->componentStockService->getAllComponentStock(componentId: $component->id, filters: $request->only(['draw', 'start', 'length', 'order', 'search'])));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Component $component)
  {
    return view('modules.components.stocks.create', ['component' => $component]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreComponentStockRequest $request)
  {
    $dto = StoreComponentStockDTO::fromRequest($request->validated());

    $this->componentStockService->store($dto);

    return redirect()
      ->route('components.stocks.index', $dto->component_id)
      ->with('flash', ['type' => 'success', 'message' => 'Component Stocks created successfully.']);
  }

  public function checkout(CheckoutRequest $request)
  {
    // Just call the service
    $this->componentStockCheckoutService->handle($request->validated());

    // If successful, redirect with success flash
    return redirect()
      ->route('components.stocks.index', $request->component_id)
      ->with('flash', [
        'type' => 'success',
        'message' => 'Checkout successfully.',
      ]);
  }

  /**
   * Display the specified resource.
   */
  public function detail(Component $component, ComponentStock $stock)
  {
    return view('modules.components.stocks.detail', [
      'component' => $component,
      'stock' => $stock,
    ]);
  }

  public function history(Component $component, ComponentStock $stock, Request $request)
  {
    return response()->json($this->stockHistoryService->getHistory(componentId: $component->id, componentStockId: $stock->id, filters: $request->only(['draw', 'start', 'length', 'order', 'search'])));
  }

  public function stockDetail(Component $component, ComponentStock $stock, Request $request)
  {
    return response()->json($this->componentStockService->getStockDetail(componentId: $component->id, componentStockId: $stock->id));
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
