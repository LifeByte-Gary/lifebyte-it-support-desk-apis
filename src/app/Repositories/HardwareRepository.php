<?php

namespace App\Repositories;

use App\Interfaces\HardwareInterface;
use App\Models\Hardware;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class HardwareRepository implements HardwareInterface
{
    public function findHardware(array $filter): Collection|array|LengthAwarePaginator
    {
        $name = $filter['name'] ?? null;
        $type = $filter['type'] ?? null;
        $brand = $filter['brand'] ?? null;
        $serialNumber = $filter['serial_number'] ?? null;
        $tag = $filter['tag'] ?? null;
        $paginate = !(isset($filter['paginate']) && $filter['paginate'] === 'false');

        $query = Hardware::with('user')
            ->when($name, function ($query, $name) {
                $query->where('name', 'like', "%$name%");
            })
            ->when($type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->when($brand, function ($query, $brand) {
                $query->where('brand', 'like', "%$brand%");
            })
            ->when($serialNumber, function ($query, $serialNumber) {
                $query->where('serial_number', 'like', "%$serialNumber%");
            })
            ->when($tag, function ($query, $tag) {
                $query->where('tag', 'like', "%$tag%");
            });

        return $paginate ? $query->paginate() : $query->get();
    }

    public function findAHardwareById(string $id): Model|Collection|Builder|array|null
    {
        return Hardware::findOrFail($id)->loadMissing('user');
    }
}
