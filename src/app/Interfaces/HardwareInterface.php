<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface HardwareInterface
{
    public function findHardware(array $filter): Collection|array|LengthAwarePaginator;
}
