<?php

namespace App\Services;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(): AnonymousResourceCollection
    {
        return UserResource::collection($this->userRepository->all());
    }

    public function findAUserById($id): UserResource
    {
        return new UserResource(User::findOrFail($id));
    }

    public function fuzzySearchUsersByName(string|null $name): AnonymousResourceCollection
    {
        if (isset($name)) {
            return UserResource::collection($this->userRepository->fuzzySearchByName($name));
        }

        return UserResource::collection($this->userRepository->all());
    }

    public function createAUser(UserCreateRequest $request): Model|User
    {
        $input = $request->all();
        $input['location_id'] = $request->input('location')['id'];
        $input['password'] = Hash::make($input['password']);

        return User::create($input);
    }

    public function updateAUser(UserUpdateRequest $request, User $user): void
    {
        $user->name = $request->input('name') ?: $user->name;
        $user->email = $request->input('email') ?: $user->email;
        $user->company = $request->input('company') ?: $user->company;
        $user->desk = $request->input('desk') ?: $user->desk;
        $user->department = $request->input('department') ?: $user->department;
        $user->job_title = $request->input('job_title') ?: $user->job_title;
        $user->type = $request->input('type') ?: $user->type;
        $user->location_id = $request->input('location')['id'] ?: $user->location_id;
        $user->state = $request->input('state') ?: $user->state;

        if ($request->user()->isSuperAdmin()) {
            $user->permission_level = $request->input('permission_level') ?: $user->permission_level;
        }

        $user->save();
    }
}
