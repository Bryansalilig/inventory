<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DTOs\Components\StoreComponentDTO;

use App\Contracts\Components\ComponentServiceInterface;
use App\Contracts\Components\ComponentCheckoutServiceInterface;

use App\Http\Requests\Components\StoreComponentRequest;

use App\Models\Component\Component;

class ComponentsController extends Controller
{
  /**
   * Constructor method to set up session data.
   *
   * This method initializes session variables for view and menu navigation
   * within the Forms > Yearly Development.
   */
  // Property to hold the injected implementation
  public function __construct(protected ComponentServiceInterface $componentService, protected ComponentCheckoutServiceInterface $componentCheckoutService) {}

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('modules.components.index');
  }

  public function getData(Request $request)
  {
    return response()->json($this->componentService->getAllComponent($request));
  }

  public function checkout(CheckoutRequest $request)
  {
    // Just call the service
    $this->componentCheckoutService->handle($request->validated());

    // If successful, redirect with success flash
    return redirect()
      ->route('components.index')
      ->with('flash', [
        'type' => 'success',
        'message' => 'Checkout successfully.',
      ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('modules.components.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreComponentRequest $request)
  {
    $dto = StoreComponentDTO::fromRequest($request->validated());

    $this->componentService->store($dto);

    return redirect()
      ->route('components.index')
      ->with('flash', ['type' => 'success', 'message' => 'Component created successfully.']);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id) {}

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
