<?php

namespace App\DTOs\Assets;

class UpdateAssetDTO
{
  public function __construct(public readonly int $componentId, public readonly string $assetTag, public readonly int $selectedAssetId) {}

  public static function fromArray(array $data): self
  {
    return new self(componentId: (int) $data['component_id'], assetTag: (string) $data['asset_tag'], selectedAssetId: (int) $data['selected_asset_tag']);
  }

  public function toArray(): array
  {
    return [
      'component_id' => $this->componentId,
      'asset_tag' => $this->assetTag,
      'selected_asset_tag' => $this->selectedAssetId,
    ];
  }
}
