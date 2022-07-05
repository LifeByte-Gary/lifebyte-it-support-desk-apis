<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserInterface
{
    public function findUsers(array $filter): Collection|array|LengthAwarePaginator
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
