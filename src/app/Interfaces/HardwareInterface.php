<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface HardwareInterface
{
    public function all(): LengthAwarePaginator;
}
