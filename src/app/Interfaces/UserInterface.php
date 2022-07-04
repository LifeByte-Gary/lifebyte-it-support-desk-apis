<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserInterface
{
    public function all(bool $pagination): Collection|LengthAwarePaginator;

    public function fuzzySearchByName(string $name): LengthAwarePaginator;

    public function findUsers(array $filter);
}
