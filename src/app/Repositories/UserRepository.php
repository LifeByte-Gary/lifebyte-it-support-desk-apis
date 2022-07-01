<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserInterface
{
    public function all(bool $pagination): Collection|LengthAwarePaginator
    {
        return $pagination ? User::paginate()->withQueryString() : User::all();
    }

    public function fuzzySearchByName(string $name): LengthAwarePaginator
    {
        return User::where('name', 'LIKE', "%{$name}%")->paginate()->withQueryString();
    }
}
