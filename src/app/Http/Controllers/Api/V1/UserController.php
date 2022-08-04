<?php

namespace App\Http\Controllers\Api\V1;

use App\Exports\UsersExport;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Imports\UsersImport;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $filter = $request->query();

        return UserResource::collection($this->userRepository->findUsers($filter));
    }

    public function show(string $id): UserResource
    {
        return new UserResource($this->userRepository->findAUserById($id));
    }

    public function store(UserCreateRequest $request): UserResource
    {
        return new UserResource($this->userRepository->createAUser($request));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->userRepository->updateAUser($request, $user);

        return response(null, 204);
    }

    public function import(Request $request)
    {
        try {
            Excel::import(new UsersImport, $request->file('file'));

            return response(null, 204);
        } catch (Exception) {
            return response('Failed to import', 500);
        }
    }

    public function export()
    {
        try {
            return Excel::download(new UsersExport, 'users.xlsx');
        } catch (Exception) {
            return response('Failed to export', 500);
        }
    }
}
