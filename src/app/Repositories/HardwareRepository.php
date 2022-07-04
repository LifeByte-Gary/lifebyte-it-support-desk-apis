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

    public function filter(array $filter): LengthAwarePaginator
    {
        if (!count($filter)) {
            return $this->all();
        }

        $name = $filter['name'] ?? null;
        $type = $filter['type'] ?? null;

        return Hardware::when($name, static function ($query, $name) {
            $query->where('name', 'like', "%$name%");
        })
            ->paginate()->withQueryString();
    }
}
