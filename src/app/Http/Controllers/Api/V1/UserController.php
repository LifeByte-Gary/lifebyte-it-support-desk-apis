<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $query = $request->query();

        $pagination = !(isset($query['pagination']) && $query['pagination'] === 'false');

        if (!$pagination) {
            return $this->userService->getAllUsers(false);
        }

        if (isset($query['name'])) {
            return $this->userService->fuzzySearchUsersByName($query['name']);
        }

        return $this->userService->getAllUsers();
    }

    public function show($id): UserResource
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
