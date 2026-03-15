<?php

namespace Database\Factories;

use App\Models\Exercise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Exercise>
 */
class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $exercises = [
            'Bench Press',
            'Squat',
            'Deadlift',
            'Pull Up',
            'Push Up',
            'Overhead Press',
            'Barbell Row',
            'Dumbbell Curl',
            'Triceps Extension',
            'Leg Press',
            'Leg Curl',
            'Leg Extension',
            'Lateral Raise',
            'Front Raise',
            'Chest Fly',
            'Lat Pulldown',
            'Face Pull',
            'Hip Thrust',
            'Glute Bridge',
            'Calf Raise'
        ];

        $name = $this->faker->randomElement($exercises);

        return [
            'name' => $name,
            'description' => $this->faker->sentence(10),
        ];
    }
}
