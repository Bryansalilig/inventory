<?php

namespace App\Http\Controllers\Assets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Assets\UpdateAssetRequest;

use App\DTOs\Assets\UpdateAssetDTO;

use App\Contracts\Assets\AssetServiceInterface;

class AssetsController extends Controller
{
  /**
   * Constructor method to set up session data.
   *
   * This method initializes session variables for view and menu navigation
   * within the Forms > Yearly Development.
   */
  // Property to hold the injected implementation
  protected AssetServiceInterface $assetService;

  public function __construct(AssetServiceInterface $assetService)
  {
    // Assign the injected service to the controller’s property for later use
    $this->assetService = $assetService;
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('modules.assets.index');
  }

  public function getData(Request $request)
  {
    return response()->json($this->assetService->getAllAsset($request));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('modules.assets.create');
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
  public function update(UpdateAssetRequest $request)
  {
    $dto = UpdateAssetDTO::fromArray($request->validated());

    $this->assetService->updateAsset($dto);

    return response()->json([
      'message' => 'Asset changed successfully.',
    ]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
