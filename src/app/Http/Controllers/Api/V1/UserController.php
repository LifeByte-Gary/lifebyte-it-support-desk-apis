<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    public function show(Request $request, User $user)
    {
    }

    public function store(UserCreateRequest $request): Application|ResponseFactory|Response
    {
        $this->userService->createAUser($request);

        return response(null, 204);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->userService->updateAUser($request, $user);

        return response(null, 204);
    }
}
