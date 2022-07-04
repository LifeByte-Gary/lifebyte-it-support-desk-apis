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
            'Apple M2',
            'Intel Core i5',
            'Intel Core i7',
        ];

        $ports = [
            'USB (Male)',
            'USB (Female)',
            'USB-C (Male)',
            'USB-C (Female)',
            'HDMI (Male)',
            'HDMI (Female)',
            'DisplayPort (Male)',
            'DisplayPort (Female)',
            'Mini DisplayPort (Male)',
            'Mini DisplayPort (Female)',
            'VGA (Female)',
            'DVI (Female)',
        ];

        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'type' => $this->faker->randomElement($types),
            'brand' => $this->faker->company(),
            'serial_number' => $this->faker->uuid(),
            'tag' => $this->faker->uuid(),
            'spec_os' => $systems[array_rand($systems)],
            'spec_cpu' => $cpus[array_rand($cpus)],
            'spec_memory' => $this->faker->randomDigit(),
            'spec_screen_size' => $this->faker->numberBetween(10, 40),
            'spec_ports' => $this->faker->randomElements($ports, 3),
            'spec_adapter_input' => $ports[array_rand($ports)],
            'spec_adapter_output' => $this->faker->randomElements($ports, 2),
            'spec_cable_length' => $this->faker->numberBetween(1, 20),
            'spec_others' => $this->faker->sentence(),
            'together' => $this->faker->sentences(),
            'note' => $this->faker->paragraph()
        ];
    }
}
