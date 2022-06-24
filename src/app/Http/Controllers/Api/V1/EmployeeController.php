<?php

namespace App\Http\Controllers\Api\V1;

use App\Traits\EmployeeTrait;
use Exception;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        try {
            return EmployeeTrait::GetAllEmployees();

        } catch (Exception $exception) {
            return response('Failed to load employee list.', 500);
        }
    }
}
