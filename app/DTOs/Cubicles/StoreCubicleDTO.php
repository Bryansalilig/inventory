<?php
namespace App\DTOs\Cubicles;

class StoreCubicleDTO
{
  public function __construct(public int $location, public string $name, public string $last_cubicle, public int $quantity) {}

  public static function fromRequest(array $data): self
  {
    return new self(location: (int) $data['location'], name: $data['name'], last_cubicle: $data['last_cubicle'], quantity: (int) $data['quantity']);
  }
}
