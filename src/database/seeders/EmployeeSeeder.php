<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $admin = new Employee();
        $admin->name = 'Aaron Dai';
        $admin->email = 'aaron@lifebyte.io';
        $admin->department = 'IT Support';
        $admin->job_title = 'IT Support';
        $admin->location_office = '55C';
        $admin->location_position = 'Table 0';
        $admin->state = 1;
        $admin->is_admin = true;
        $admin->password = Hash::make('111111');

        $admin->save();

        Employee::factory(100)
            ->create();
    }
}
