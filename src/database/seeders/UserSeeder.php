<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Set users for the ease of testing.
        User::factory()->create([
            'name' => 'Gary Zhang',
            'email' => 'gary@lifebyte.io',
            'department' => 'IT Support',
            'job_title' => 'IT',
            'office_id' => 1,
            'desk' => 'Desk 1',
            'state' => 1,
            'type' => 'Employee',
            'permission_level' => 2
        ]);

        User::factory()->create([
            'name' => 'Aaron Dai',
            'email' => 'aaron@lifebyte.io',
            'department' => 'IT Support',
            'job_title' => 'IT',
            'office_id' => 1,
            'desk' => 'Desk 2',
            'state' => 1,
            'type' => 'Employee',
            'permission_level' => 1
        ]);

        User::factory(100)
            ->create();
    }
}
