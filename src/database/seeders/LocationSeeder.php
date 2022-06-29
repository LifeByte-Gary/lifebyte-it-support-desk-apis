<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $offices = [
            [
                'name' => '55C',
                'company' => 'LifeByte',
                'country' => 'Australia'
            ],
            [
                'name' => '2801',
                'company' => 'TMGM',
                'country' => 'Australia'
            ],
            [
                'name' => '3003',
                'company' => 'TMGM',
                'country' => 'Australia'
            ],
            [
                'name' => 'China Office',
                'company' => 'TMGM',
                'country' => 'China'
            ],
            [
                'name' => 'India Office',
                'company' => 'TMGM',
                'country' => 'India'
            ],
            [
                'name' => '7003',
                'company' => 'TMGM',
                'country' => 'Thailand'
            ],
            [
                'name' => 'RV Office',
                'company' => 'TMGM',
                'country' => 'Australia'
            ],
            [
                'name' => 'Cyprus Office',
                'company' => 'TMGM',
                'country' => 'Europe'
            ],
            [
                'name' => 'France Office',
                'company' => 'TMGM',
                'country' => 'Europe'
            ],
            [
                'name' => 'Germany Office',
                'company' => 'TMGM',
                'country' => 'Europe'
            ],
            [
                'name' => 'Italy Office',
                'company' => 'TMGM',
                'country' => 'Europe'
            ],
            [
                'name' => 'UK Office',
                'company' => 'TMGM',
                'country' => 'Europe'
            ],
            [
                'name' => '6005',
                'company' => 'TMGM',
                'country' => 'New Zealand'
            ],
            [
                'name' => '-',
                'company' => 'TMGM',
                'country' => 'Australia'
            ],
        ];

        foreach ($offices as $office) {
            Location::create($office);
        }
    }
}
