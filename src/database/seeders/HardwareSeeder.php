<?php

namespace Database\Seeders;

use App\Models\Hardware;
use Illuminate\Database\Seeder;

class HardwareSeeder extends Seeder
{
    public function run(): void
    {

        Hardware::factory(500)->create();
    }
}
