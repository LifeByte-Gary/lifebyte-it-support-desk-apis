<?php

namespace App\Interfaces;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserInterface
{
    public function findUsers(array $filter): Collection|array|LengthAwarePaginator;

    public function findAUserById(string $id): Model|Collection|Builder|array|null;

    public function createAUser(UserCreateRequest $request): User;

    public function updateAUser(UserUpdateRequest $request, User $user): void;

}
