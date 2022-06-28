<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
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

    public function show(Request $request, $id): UserResource
    {
        return $this->userService->findAUserById($id);
    }

    public function store(UserCreateRequest $request)
    {
        $newUser = $this->userService->createAUser($request);

        return response($newUser);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->userService->updateAUser($request, $user);

        return response(null, 204);
    }
}
