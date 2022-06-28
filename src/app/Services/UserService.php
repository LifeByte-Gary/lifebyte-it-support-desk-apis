<?php

namespace App\Services;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Integer;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(): UserCollection
    {
        return new UserCollection($this->userRepository->all());
    }

    public function findAUserById(Integer $id): UserResource
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    public function fuzzySearchUsersByName(string|null $name): UserCollection
    {
        if (isset($name)) {
            return new UserCollection($this->userRepository->fuzzySearchByName($name));
        }

        return new UserCollection($this->userRepository->all());
    }

    public function createAUser(UserCreateRequest $request): void
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        User::create($input);
    }

    public function updateAUser(UserUpdateRequest $request, User $user): void
    {
        $user->name = $request->input('name') ?: $user->name;
        $user->email = $request->input('email') ?: $user->email;
        $user->department = $request->input('department') ?: $user->department;
        $user->job_title = $request->input('job_title') ?: $user->job_title;
        $user->location_office = $request->input('location_office') ?: $user->location_office;
        $user->location_position = $request->input('location_position') ?: $user->location_position;
        $user->state = $request->input('state') ?: $user->state;
        $user->is_admin = $request->input('is_admin') ?: $user->is_admin;

        $user->save();
    }
}
