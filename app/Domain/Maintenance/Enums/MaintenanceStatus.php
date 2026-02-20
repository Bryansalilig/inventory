<?php

namespace App\Domain\Maintenance\Enums;

enum MaintenanceStatus: string
{
  case Maintenance = 'Maintenance';
  case Disposal = 'Disposal';
  case Repaired = 'Repaired';
}
