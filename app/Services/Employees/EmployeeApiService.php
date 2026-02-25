<?php
namespace App\Services\Employees;

use App\Contracts\Employees\EmployeeApiServiceInterface;
use App\DTOs\Employees\EmployeeAPIDTO;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use RuntimeException;

use App\Contracts\Employees\EmployeeRepositoryInterface;

class EmployeeApiService implements EmployeeApiServiceInterface
{
  protected string $baseUrl;

  public function __construct(private EmployeeRepositoryInterface $employeeRepository)
  {
    $this->baseUrl = config('services.employee_api.url') ?? throw new RuntimeException('EMPLOYEE_API_URL not configured');
  }

  /**
   * Get all employees from API, cached for performance.
   *
   * @return EmployeeAPIDTO[]
   */
  public function getAll(): array
  {
    return Cache::remember('employees.all', 300, function () {
      $response = Http::timeout(10)
        ->retry(2, 100) // 2 retries, 100ms pause
        ->get("{$this->baseUrl}/employee-list");

      if ($response->failed()) {
        throw new RuntimeException('Employee API unavailable');
      }

      $data = $response->json()['data'] ?? [];

      // Map raw array to EmployeeAPIDTO objects
      return array_map(fn($e) => new EmployeeAPIDTO(id: $e['id'], fullname: $e['fullname'] ?? ($e['name'] ?? ''), email: $e['email'] ?? null, position: $e['position_name'] ?? null), $data);
    });
  }

  /**
   * Get employees for select/dropdown
   *
   * @return array
   */
  public function getForSelect(): array
  {
    return array_map(
      fn(EmployeeAPIDTO $e) => [
        'id' => $e->id,
        'fullname' => $e->fullname,
        'email' => $e->email,
        'position' => $e->position,
      ],
      $this->getAll(),
    );
  }

  public function getEmpDropdown(): array
  {
    $employees = collect($this->getForSelect());

    $existingIds = $this->employeeRepository->getExistingEmployeeIds();

    return $employees->reject(fn($emp) => in_array($emp['id'], $existingIds))->values()->toArray();
  }

  public function getEmpAssetDropdown(int $componentId): array
  {
    $employees = collect($this->getForSelect());

    $assignedEmployeeIds = $this->employeeRepository->getEmployeeIdsWithAssignedAssets($componentId);

    // O(1) lookup instead of O(n)
    $assignedLookup = array_flip($assignedEmployeeIds);

    return $employees->reject(fn($emp) => isset($assignedLookup[$emp['id']]))->values()->toArray();
  }
}
