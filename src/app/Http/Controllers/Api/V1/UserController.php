<?php

namespace App\Http\Controllers\Api\V1;

use App\Traits\UserTrait;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        try {
            return UserTrait::GetAllEmployees();
        } catch (Exception $exception) {
            return response($exception, 500);
        }
    }
}
