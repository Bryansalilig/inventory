<?php

namespace App\Services\ComponentStocks;

use Illuminate\Support\Facades\DB;
use App\Exceptions\ComponentNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Models\Asset\Asset;

use App\Http\Requests\Components\StoreComponentRequest;

use App\DTOs\ComponentStocks\StoreComponentStockDTO;

use App\Contracts\ComponentStocks\ComponentStockServiceInterface;
use App\Contracts\ComponentStocks\ComponentStockRepositoryInterface;

class ComponentStockService implements ComponentStockServiceInterface
{
  public function __construct(protected ComponentStockRepositoryInterface $componentStockRepo) {}

  public function getAllComponentStock(int $componentId, array $filters): array
  {
    return $this->componentStockRepo->getByComponentId(componentId: $componentId, filters: $filters);
  }

  public function store(StoreComponentStockDTO $dto): void
  {
    try {
      DB::transaction(function () use ($dto) {
        $this->componentStockRepo->store($dto);
      });
    } catch (\Throwable $e) {
      // log error
      \Log::error('Failed to store component stocks', [
        'message' => $e->getMessage(),
        'dto' => $dto,
      ]);

      // rethrow or custom domain exception
      throw new \RuntimeException('Failed to store component stocks. Please try again.');
    }
  }

  public function generateUniqueAssetTag(string $prefix): string
  {
    $latest = Asset::where('asset_tag', 'LIKE', $prefix . '-%')
      ->orderBy('asset_tag', 'desc')
      ->first();

    if (!$latest) {
      return $prefix . '-000001';
    }

    // Extract last 6 digits
    preg_match('/(\d{6})$/', $latest->asset_tag, $matches);

    $nextNumber = isset($matches[1]) ? (int) $matches[1] + 1 : 1;

    return $prefix . '-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
  }

  public function getStockDetail(int $componentId, int $componentStockId)
  {
    return $this->componentStockRepo->getStockDetail($componentId, $componentStockId);
  }
}
