<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companies = [
            'LifeByte',
            'TMGM'
        ];

        $departments = [
            'IT Support',
            'Development',
            'BA',
            'DevOp',
            'Risk'
        ];

        $types = [
            'Employee',
            'Storage',
            'Meeting Room',
            'Others'
        ];

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'company' => $companies[array_rand($companies)],
            'department' => $departments[array_rand($departments)],
            'job_title' => $this->faker->jobTitle(),
            'location_id' => $this->faker->numberBetween(1, 14),
            'desk' => 'Desk ' . $this->faker->randomNumber(2),
            'state' => $this->faker->numberBetween(0, 1),
            'type' => $types[array_rand($types)],
            'permission_level' => 0,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
