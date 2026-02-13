<?php

namespace App\Services\Components;

use Illuminate\Support\Facades\DB;
use App\Exceptions\ComponentNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Http\Requests\Components\StoreComponentRequest;

use App\DTOs\Components\StoreComponentDTO;

use App\Contracts\Components\ComponentServiceInterface;
use App\Contracts\Components\ComponentRepositoryInterface;

class ComponentService implements ComponentServiceInterface
{
  public function __construct(protected ComponentRepositoryInterface $componentRepo) {}

  public function getAllComponent(Request $request): array
  {
    return $this->componentRepo->getAllComponent($request);
  }

  public function store(StoreComponentDTO $dto): void
  {
    try {
      DB::transaction(function () use ($dto) {
        $this->componentRepo->store($dto);
      });
    } catch (\Throwable $e) {
      // log error
      \Log::error('Failed to store component', [
        'message' => $e->getMessage(),
        'dto' => $dto,
      ]);

      // rethrow or custom domain exception
      throw new \RuntimeException('Failed to store component. Please try again.');
    }
  }
}
