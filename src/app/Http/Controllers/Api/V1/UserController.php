<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\UserCollection;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request): UserCollection
    {
        $query = $request->query();

        if (array_key_exists('email', $query)) {
            return $this->userService->getAllUsers();
        }

        if (array_key_exists('name', $query)) {
            return $this->userService->fuzzySearchUsersByName($query['name']);
        }

        return $this->userService->getAllUsers();
    }
}
