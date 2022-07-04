<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelIdea\Helper\App\Models\_IH_User_C;

class UserRepository implements UserInterface
{
    public function all(bool $pagination): Collection|LengthAwarePaginator
    {
        return $pagination ? User::paginate()->withQueryString() : User::all();
    }

    public function fuzzySearchByName(string $name): LengthAwarePaginator
    {
        return User::where('name', 'LIKE', "%{$name}%")->paginate()->withQueryString();
    }

    public function findUsers(array $filter): Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator|array|_IH_User_C|LengthAwarePaginator
    {
        $name = $filter['name'] ?? null;
        $email = $filter['email'] ?? null;
        $department = $filter['department'] ?? null;
        $jobTitle = $filter['job_title'] ?? null;
        $locationId = $filter['location_id'] ?? null;
        $state = isset($filter['state']) ? (int)$filter['state'] : null;
        $permissionLevel = isset($filter['permission_level']) ? (int)$filter['permission_level'] : null;
        $paginate = !(isset($filter['paginate']) && $filter['paginate'] === 'false');

        $query = User::when($name, static function ($query, $name) {
            $query->where('name', 'like', "%$name%");
        })->when($email, static function ($query, $email) {
            $query->where('email', 'like', "%$email%");
        })->when($department, function ($query, $department) {
            $query->where('department', $department);
        })->when($jobTitle, function ($query, $jobTitle) {
            $query->where('job_title', 'like', "%$jobTitle%");
        })->when($locationId, function ($query, $locationId) {
            $query->where('location_id', $locationId);
        });

        if (isset($state)) {
            $query->where('state', $state);
        }

        if (isset($permissionLevel)) {
            $query->where('permission_level', $permissionLevel);
        }

        return $paginate ? $query->paginate() : $query->get();
    }
}
