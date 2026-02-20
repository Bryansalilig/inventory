<?php

namespace App\Services\Logs;

use Illuminate\Support\Facades\DB;
use App\Exceptions\ComponentNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

use App\Contracts\Logs\LogServiceInterface;
use App\Contracts\Logs\LogRepositoryInterface;

class LogService implements LogServiceInterface
{
  public function __construct(protected LogRepositoryInterface $logRepository) {}

  public function getAllLog(array $filters): array
  {
    return $this->logRepository->getAllLog($filters);
  }
}
