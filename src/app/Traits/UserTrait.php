<?php

namespace App\Traits;

use App\Http\Resources\UserCollection;
use App\Models\User;

trait UserTrait
{
    public static function GetAllEmployees(): UserCollection
    {
        return new UserCollection(User::paginate());
    }
}
