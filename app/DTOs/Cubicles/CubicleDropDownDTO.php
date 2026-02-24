<?php
namespace App\DTOs\Cubicles;

use App\Models\Cubicle\Cubicle;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class CubicleDropDownDTO
{
  public function __construct(public int $id, public string $name, public string $location) {}

  public static function fromModel(Cubicle $cubicle): self
  {
    return new self(id: $cubicle->id, name: $cubicle->name, location: self::mapLocation($cubicle->location));
  }

  private static function mapLocation(?int $location): string
  {
    return match ($location) {
      1 => 'HR Floor',
      2 => '2nd Floor',
      3 => '3rd Floor',
      4 => '4th Floor',
      default => '5th Floor',
    };
  }

  public static function collection(Collection $cubicles): array
  {
    return $cubicles->map(fn(Cubicle $c) => (array) self::fromModel($c))->toArray();
  }
}

/**
 * Create a DTO from a Request object (used for storing/updating).
 * Ginagawa silang plain, strongly-typed DTO (object)
 * Ibinabalik ang JobDTO object na handang gamitin ng Service layer o repository
 */
