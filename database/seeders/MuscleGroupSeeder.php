<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MuscleGroup;

class MuscleGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            'Peito',
            'Costas',
            'Pernas',
            'Ombros',
            'Braços',
            'Core'
        ];

        foreach ($groups as $group) {
            MuscleGroup::create(['name' => $group]);
        }
    }
}
