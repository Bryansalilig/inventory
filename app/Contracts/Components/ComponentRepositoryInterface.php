<?php

namespace App\Contracts\Components;

use Illuminate\Http\Request;

interface ComponentRepositoryInterface
{
  /**
   * Fetch components from persistence layer
   */
  public function getAllComponent(Request $request): array;
}
