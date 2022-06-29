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
                'name' => '1011',
                'company' => 'TMGM',
                'country' => 'AU'
            ],
            [
                'name' => '55C',
                'company' => 'LifeByte',
                'country' => 'AU'
            ],
            [
                'name' => '2800',
                'company' => 'TMGM',
                'country' => 'AU'
            ],
            [
                'name' => '-',
                'company' => 'TMGM',
                'country' => 'AU'
            ],
        ];

        foreach ($offices as $office) {
            Location::create($office);
        }
    }
}
