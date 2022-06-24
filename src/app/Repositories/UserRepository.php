<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserInterface
{
    public function all(): LengthAwarePaginator
    {
        return User::paginate()->withQueryString();
    }

    public function fuzzySearchByName(String $name): LengthAwarePaginator
    {
        return User::where('name', 'LIKE', "%{$name}%")->paginate()->withQueryString();
    }
}
