<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\rak>
 */
class rakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rak' => fake()->unique()->randomElement(['A','B', 'D', 'C']),
            'no_rak' => fake()->unique()->randomElement(['1','2','3','4'])
        ];
    }
}
