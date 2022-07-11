<?php

namespace App\Repositories;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    public function findUsers(array $filter): Collection|array|LengthAwarePaginator
    {
        $name = $filter['name'] ?? null;
        $email = $filter['email'] ?? null;
        $department = $filter['department'] ?? null;
        $jobTitle = $filter['job_title'] ?? null;
        $company = $filter['company'] ?? null;
        $desk = $filter['desk'] ?? null;
        $type = $filter['type'] ?? null;
        $locationId = $filter['location_id'] ?? null;
        $state = isset($filter['state']) ? (int)$filter['state'] : null;
        $permissionLevel = isset($filter['permission_level']) ? (int)$filter['permission_level'] : null;
        $paginate = !(isset($filter['paginate']) && $filter['paginate'] === 'false');

        $query = User::with('location')
            ->when($name, static function ($query, $name) {
                $query->where('name', 'like', "%$name%");
            })
            ->when($email, static function ($query, $email) {
                $query->where('email', 'like', "%$email%");
            })
            ->when($department, function ($query, $department) {
                $query->where('department', $department);
            })
            ->when($jobTitle, function ($query, $jobTitle) {
                $query->where('job_title', 'like', "%$jobTitle%");
            })
            ->when($company, function ($query, $company) {
                $query->where('company', 'like', "%$company%");
            })
            ->when($desk, function ($query, $desk) {
                $query->where('desk', 'like', "%$desk%");
            })
            ->when($locationId, function ($query, $locationId) {
                $query->where('location_id', $locationId);
            })
            ->when($type, function ($query, $type) {
                $query->where('type', $type);
            });

        if (isset($state)) {
            $query->where('state', $state);
        }

        if (isset($permissionLevel)) {
            $query->where('permission_level', $permissionLevel);
        }

        return $paginate ? $query->paginate() : $query->get();
    }

    public function findAUserById(string $id): Model|Collection|Builder|array|null
    {
        return User::findOrFail($id)->loadMissing('location');
    }

    public function createAUser(UserCreateRequest $request): User
    {
        $user = $request->all();

        return User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'department' => $user['department'] ?? null,
            'job_title' => $user['job_title'] ?? null,
            'company' => $user['company'] ?? null,
            'desk' => $user['desk'] ?? null,
            'location_id' => $user['location_id'],
            'state' => $user['state'],
            'type' => $user['type'],
            'password' => Hash::make('password'),
            'permission_level' => $user['permission_level']
        ]);
    }

    public function updateAUser(UserUpdateRequest $request, User $user): void
    {
        $user->name = $request->input('name') ?? $user->name;
        $user->email = $request->input('email') ?? $user->email;
        $user->company = $request->input('company') ?? $user->company;
        $user->department = array_key_exists('department', $request->input()) ? $request->input('department') : $user->department;
        $user->job_title = array_key_exists('job_title', $request->input()) ? $request->input('job_title') : $user->job_title;
        $user->desk = array_key_exists('desk', $request->input()) ? $request->input('desk') : $user->desk;
        $user->location_id = $request->input('location_id') ?? $user->location_id;
        $user->type = $request->input('type') ?? $user->type;
        $user->state = $request->input('state') ?? $user->state;
        $user->permission_level = $request->input('permission_level') ?? $user->permission_level;

        $user->save();
    }
}
