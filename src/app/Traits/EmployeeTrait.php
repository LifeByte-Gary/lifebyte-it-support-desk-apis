<?php

namespace App\Traits;

use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;

trait EmployeeTrait
{
    public static function GetAllEmployees(): EmployeeCollection
    {
        return new EmployeeCollection(Employee::paginate());
    }
}
