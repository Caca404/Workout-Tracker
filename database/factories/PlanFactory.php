<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakeName = fake()->name();
        return [
            'name' => $fakeName,
            'slug' => Str::slug($fakeName),
            'description' => fake()->sentence(),
            'difficulty' => fake()->randomElement(['beginner', 'intermediate', 'advanced']),
            'is_template' => fake()->boolean(),
        ];
    }
}
