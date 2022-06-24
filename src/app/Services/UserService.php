<?php

namespace App\Services;

use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Repositories\UserRepository;

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

    public function fuzzySearchUsersByName(String $name): UserCollection
    {
        return new UserCollection($this->userRepository->fuzzySearchByName($name));
    }
}
