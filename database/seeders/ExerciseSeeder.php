<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\ExerciseFactory;
use App\Models\Category;
use App\Models\MuscleGroup;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $muscleGroups = MuscleGroup::all();

        ExerciseFactory::factory()
            ->count(50)
            ->create()
            ->each(function ($exercise) use ($categories, $muscleGroups) {
                $exercise->categories()->attach(
                    $categories->random(rand(1, 2))->pluck('id')
                );

                $exercise->muscleGroups()->attach(
                    $muscleGroups->random(rand(1, 4))->pluck('id')
                );
            });
    }
}
