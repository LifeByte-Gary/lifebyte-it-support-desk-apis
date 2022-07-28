<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HardwareFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [
            'Desktop',
            'Laptop',
            'Mouse',
            'Keyboard',
            'Adapter',
            'Docking Station',
            'TV',
            'Monitor',
            'Phone',
            'Others'
        ];

        $systems = [
            'Windows',
            'macOS',
            'Linux'
        ];

        $cpus = [
            'Apple M1',
            'Apple M1 Pro',
            'Apple M1 Max',
            'Apple M1 Ultra',
            'Apple M2',
            'Intel Core i5',
            'Intel Core i7',
            'Intel Core i9',
        ];

        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'type' => $this->faker->randomElement($types),
            'brand' => $this->faker->company(),
            'model' => $this->faker->word(),
            'serial_number' => $this->faker->uuid(),
            'tag' => $this->faker->uuid(),
            'spec_os' => $systems[array_rand($systems)],
            'spec_cpu' => $cpus[array_rand($cpus)],
            'spec_memory' => $this->faker->randomDigit(),
            'spec_storage' => $this->faker->numberBetween(200, 800),
            'spec_screen_size' => $this->faker->numberBetween(10, 40),
            'spec_others' => $this->faker->sentence(),
            'bundle_with' => $this->faker->sentences(),
            'note' => $this->faker->paragraph()
        ];
    }
}
