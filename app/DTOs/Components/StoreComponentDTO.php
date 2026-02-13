<?php
namespace App\DTOs\Components;

use Illuminate\Http\UploadedFile;

class StoreComponentDTO
{
  public function __construct(public string $name, public string $asset_tag, public ?UploadedFile $picture) {}

  public static function fromRequest(array $data): self
  {
    return new self(name: $data['name'], asset_tag: $data['asset_tag'], picture: $data['picture'] ?? null);
  }
}
