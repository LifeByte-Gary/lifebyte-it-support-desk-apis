<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    private UserService $userService;
    private UserRepository $userRepository;

    public function __construct(UserService $userService, UserRepository $userRepository)
    {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $filter = $request->query();

        return UserResource::collection($this->userRepository->findUsers($filter));
    }

    public function show(User $user): UserResource
    {
        return new UserResource($user);
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
