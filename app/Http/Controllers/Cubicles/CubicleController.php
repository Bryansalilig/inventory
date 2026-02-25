<?php

namespace App\Http\Controllers\Cubicles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Contracts\Cubicles\CubicleServiceInterface;

use App\Http\Requests\Cubicles\StoreCubicleRequest;

use App\DTOs\Cubicles\StoreCubicleDTO;

use App\Models\Cubicle\Cubicle;

class CubicleController extends Controller
{
  public function __construct(protected CubicleServiceInterface $cubicleService) {}
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('modules.cubicles.index');
  }

  public function getLastCubicle(Request $request)
  {
    $request->validate([
      'location' => ['required', 'integer'],
      'type' => ['required', 'string'], // C | T | MT
    ]);

    $last = Cubicle::where('location', $request->location)
      ->where('name', 'like', $request->type . '%')
      ->orderByRaw('LENGTH(name) DESC')
      ->orderBy('name', 'DESC')
      ->lockForUpdate()
      ->first();

    return response()->json([
      'last_cubicle' => $last?->name,
    ]);
  }

  public function getCubicles(int $location, Request $request)
  {
    return response()->json($this->cubicleService->getAllCubicle(location: $location, filters: $request->only(['draw', 'start', 'length', 'order', 'search'])));
  }

  public function dropDown()
  {
    $cubicles = $this->cubicleService->cubicleDropdown();

    // echo '<pre>';
    // print_r($cubicles);
    // return;
    return response()->json([
      'status' => 'success',
      'data' => $cubicles,
    ]);
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
  public function store(StoreCubicleRequest $request)
  {
    $dto = StoreCubicleDTO::fromRequest($request->validated());

    $this->cubicleService->store($dto);

    return response()->json(
      [
        'status' => 'success',
        'message' => 'Cubicle/s created successfully.',
      ],
      201,
    );
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
  public function update(Request $request, int $id) {}

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
