<?php

namespace App\Services\ComponentStocks;

use Illuminate\Support\Facades\DB;
use App\Exceptions\ComponentNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Http\Requests\Components\StoreComponentRequest;

use App\DTOs\Components\StoreComponentDTO;

use App\Contracts\ComponentStocks\ComponentStockServiceInterface;
use App\Contracts\ComponentStocks\ComponentStockRepositoryInterface;

class ComponentStockService implements ComponentStockServiceInterface
{
  public function __construct(protected ComponentStockRepositoryInterface $componentStockRepo) {}

  public function getAllComponentStock(Request $request): array
  {
    return $this->componentStockRepo->getAllComponentStock($request);
  }

  // public function store(StoreComponentDTO $dto): void
  // {
  //   try {
  //     DB::transaction(function () use ($dto) {
  //       $this->componentStockRepo->store($dto);
  //     });
  //   } catch (\Throwable $e) {
  //     // log error
  //     \Log::error('Failed to store component', [
  //       'message' => $e->getMessage(),
  //       'dto' => $dto,
  //     ]);

  //     // rethrow or custom domain exception
  //     throw new \RuntimeException('Failed to store component. Please try again.');
  //   }
  // }
}
