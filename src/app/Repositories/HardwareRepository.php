<?php

namespace App\Repositories;

use App\Interfaces\HardwareInterface;
use App\Models\Hardware;
use Illuminate\Pagination\LengthAwarePaginator;

class HardwareRepository implements HardwareInterface
{
    public function all(): LengthAwarePaginator
    {
        return Hardware::paginate()->withQueryString();
    }
}
