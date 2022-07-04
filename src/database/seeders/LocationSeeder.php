<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $offices = [
            [
                'name' => '55C',
                'country' => 'Australia'
            ],
            [
                'name' => '2801',
                'country' => 'Australia'
            ],
            [
                'name' => '3003',
                'country' => 'Australia'
            ],
            [
                'name' => 'China Office',
                'country' => 'China'
            ],
            [
                'name' => 'India Office',
                'country' => 'India'
            ],
            [
                'name' => '7003',
                'country' => 'Thailand'
            ],
            [
                'name' => 'RV Office',
                'country' => 'Australia'
            ],
            [
                'name' => 'Cyprus Office',
                'country' => 'Europe'
            ],
            [
                'name' => 'France Office',
                'country' => 'Europe'
            ],
            [
                'name' => 'Germany Office',
                'country' => 'Europe'
            ],
            [
                'name' => 'Italy Office',
                'country' => 'Europe'
            ],
            [
                'name' => 'UK Office',
                'country' => 'Europe'
            ],
            [
                'name' => '6005',
                'country' => 'New Zealand'
            ],
            [
                'name' => '-',
                'country' => 'Australia'
            ],
        ];

        foreach ($offices as $office) {
            Location::create($office);
        }
    }
}
