<?php

namespace App\Http\Controllers\Api\V1;

use App\Traits\UserTrait;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query();

        try {
            if (array_key_exists('email', $query)) {
                return UserTrait::getAllUsers();
            }

            if (array_key_exists('name', $query)) {
                return UserTrait::fuzzySearchUsersByName($query['name']);
            }

            return UserTrait::getAllUsers();
        } catch (Exception $exception) {
            return response($exception, 500);
        }
    }
}
