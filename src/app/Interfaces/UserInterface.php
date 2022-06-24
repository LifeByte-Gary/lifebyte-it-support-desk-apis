<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface UserInterface
{
    public function all(): LengthAwarePaginator;
    public function fuzzySearchByName(String $name): LengthAwarePaginator;
}
