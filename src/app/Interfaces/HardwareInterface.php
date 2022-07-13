<?php

namespace App\Interfaces;

use App\Http\Requests\HardwareUpdateRequest;
use App\Models\Hardware;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface HardwareInterface
{
    public function findHardware(array $filter): Collection|array|LengthAwarePaginator;

    public function findAHardwareById(string $id): Model|Collection|Builder|array|null;

    public function updateHardware(HardwareUpdateRequest $request, Hardware $hardware): void;

}
