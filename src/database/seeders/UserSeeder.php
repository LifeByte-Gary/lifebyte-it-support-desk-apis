<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Set the first user profile for the ease of testing.
        User::factory()->create([
            'name' => 'Gary Zhang',
            'email' => 'gary.zhang@lifebyte.io',
            'department' => 'IT Support',
            'job_title' => 'IT',
            'location_position' => 'Table 0',
            'state' => 1,
            'type' => 1,
            'is_admin' => true,
        ]);

        User::factory(100)
            ->create();
    }
}
