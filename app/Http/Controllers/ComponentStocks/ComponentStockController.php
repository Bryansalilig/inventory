<?php

namespace App\Http\Controllers\ComponentStocks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Component\Component;

use App\Contracts\ComponentStocks\ComponentStockServiceInterface;

class ComponentStockController extends Controller
{
  /**
   * Constructor method to set up session data.
   *
   * This method initializes session variables for view and menu navigation
   * within the Forms > Yearly Development.
   */
  // Property to hold the injected implementation
  public function __construct(protected ComponentStockServiceInterface $componentStockService) {}

  /**
   * Display a listing of the resource.
   */

  public function index(Component $component)
  {
    return view('modules.components.stocks.index', [
      'component' => $component,
    ]);
  }

  public function getData(Request $request)
  {
    return response()->json($this->componentStockService->getAllComponentStock($request));
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
  public function store(Request $request)
  {
    echo '<pre>';
    print_r($request->all());
    return;
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
