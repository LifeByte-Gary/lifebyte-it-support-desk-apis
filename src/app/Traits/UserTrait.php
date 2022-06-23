<?php

namespace App\Traits;

use App\Http\Resources\UserCollection;
use App\Models\User;

trait UserTrait
{
    public static function getAllUsers(): UserCollection
    {
        return new UserCollection(User::paginate());
    }

    public static function fuzzySearchUsersByName(String $name): UserCollection
    {
        return new UserCollection(User::where('name', 'LIKE', "%{$name}%")->paginate());
    }
}
