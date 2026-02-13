<?php
namespace App\Services\Components;

use App\Contracts\Components\ComponentCheckoutServiceInterface;
use App\Repositories\Components\ComponentRepository;
use App\Repositories\Assets\AssetRepository;
use App\Models\Asset\Asset;
use Illuminate\Support\Facades\DB;
use DomainException;

class ComponentCheckoutService implements ComponentCheckoutServiceInterface
{
  public function __construct(private ComponentRepository $componentRepository, private AssetRepository $assetRepository) {}

  public function handle(array $data): void
  {
    DB::transaction(function () use ($data) {
      $component = $this->componentRepository->findOrFail($data['component_id']);

      // Check availability
      if (!$component->isAvailable()) {
        throw new DomainException('Component out of stock.');
      }

      // Create Asset using factory method
      $asset = Asset::fromComponent(
        component: $component,
        employeeId: $data['employee_id'],
        employeeName: $data['employee_name'],
        employeePosition: $data['employee_position'],
        checkoutDate: $data['checkout_date'],
        quantity: $data['checkout_qty'],
      );

      $stored = $this->assetRepository->store($asset);

      if ($stored) {
        // Subtract stock safely
        $component->subtractComponent($data['checkout_qty']);
        $component_stored = $this->componentRepository->save($component);

        if ($component_stored) {
        }
      }
    });
  }
}
