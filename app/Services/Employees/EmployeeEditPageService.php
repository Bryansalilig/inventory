<?php

namespace App\Services\Employees;

use Illuminate\Support\Facades\DB;
use App\Exceptions\ComponentNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\DTOs\Employees\EmployeeEditDTO;
use App\DTOs\Cubicles\CubicleDropDownDTO;
use App\DTOs\Assets\AssetDropdownDTO;

use App\Contracts\Employees\EmployeeRepositoryInterface;
use App\Contracts\Cubicles\CubicleRepositoryInterface;
use App\Contracts\Assets\AssetRepositoryInterface;

class EmployeeEditPageService
{
  public function __construct(private EmployeeRepositoryInterface $employeeRepository, private CubicleRepositoryInterface $cubicleRepository, private AssetRepositoryInterface $assetRepository) {}

  public function getEditData(string $id)
  {
    $employee = $this->employeeRepository->findById($id);

    return EmployeeEditDTO::fromModel($employee);
  }

  public function getDataByType(int $id, int $component_id): array
  {
    $assets = $this->assetRepository->getDataByType($id, $component_id);

    return AssetDropdownDTO::collection($assets);
  }
}
