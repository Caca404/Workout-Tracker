<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [

            // =========================
            // PEITO
            // =========================
            [
                'name' => 'Treino de Peito',
                'description' => 'Treino focado em desenvolvimento de peitoral.',
                'difficulty' => 'beginner',
                'exercises' => [
                    [
                        'slug' => 'supino-reto',
                        'sets' => 4,
                        'reps' => 10,
                        'weight' => 20,
                        'rest_seconds' => 90,
                        'order' => 1
                    ],
                    [
                        'slug' => 'supino-inclinado',
                        'sets' => 3,
                        'reps' => 12,
                        'weight' => 18,
                        'rest_seconds' => 90,
                        'order' => 2
                    ],
                    [
                        'slug' => 'crucifixo',
                        'sets' => 3,
                        'reps' => 15,
                        'weight' => 10,
                        'rest_seconds' => 60,
                        'order' => 3
                    ],
                    [
                        'slug' => 'flexao-de-braco',
                        'sets' => 3,
                        'reps' => 20,
                        'weight' => null,
                        'rest_seconds' => 45,
                        'order' => 4
                    ],
                ]
            ],

            // =========================
            // COSTAS
            // =========================
            [
                'name' => 'Treino de Costas',
                'description' => 'Treino para fortalecimento dorsal.',
                'difficulty' => 'beginner',
                'exercises' => [
                    [
                        'slug' => 'barra-fixa',
                        'sets' => 4,
                        'reps' => 8,
                        'weight' => null,
                        'rest_seconds' => 90,
                        'order' => 1
                    ],
                    [
                        'slug' => 'remada-curvada',
                        'sets' => 4,
                        'reps' => 10,
                        'weight' => 25,
                        'rest_seconds' => 90,
                        'order' => 2
                    ],
                    [
                        'slug' => 'puxada-frontal',
                        'sets' => 3,
                        'reps' => 12,
                        'weight' => 30,
                        'rest_seconds' => 60,
                        'order' => 3
                    ],
                    [
                        'slug' => 'face-pull',
                        'sets' => 3,
                        'reps' => 15,
                        'weight' => 12,
                        'rest_seconds' => 45,
                        'order' => 4
                    ],
                ]
            ],

            // =========================
            // PERNAS
            // =========================
            [
                'name' => 'Treino de Pernas',
                'description' => 'Treino completo de membros inferiores.',
                'difficulty' => 'intermediate',
                'exercises' => [
                    [
                        'slug' => 'agachamento-livre',
                        'sets' => 4,
                        'reps' => 10,
                        'weight' => 40,
                        'rest_seconds' => 120,
                        'order' => 1
                    ],
                    [
                        'slug' => 'leg-press',
                        'sets' => 4,
                        'reps' => 12,
                        'weight' => 80,
                        'rest_seconds' => 90,
                        'order' => 2
                    ],
                    [
                        'slug' => 'cadeira-extensora',
                        'sets' => 3,
                        'reps' => 15,
                        'weight' => 35,
                        'rest_seconds' => 60,
                        'order' => 3
                    ],
                    [
                        'slug' => 'mesa-flexora',
                        'sets' => 3,
                        'reps' => 15,
                        'weight' => 30,
                        'rest_seconds' => 60,
                        'order' => 4
                    ],
                    [
                        'slug' => 'elevacao-de-panturrilha',
                        'sets' => 4,
                        'reps' => 20,
                        'weight' => 20,
                        'rest_seconds' => 45,
                        'order' => 5
                    ],
                ]
            ],

            // =========================
            // OMBROS
            // =========================
            [
                'name' => 'Treino de Ombros',
                'description' => 'Treino focado em deltoides e trapézio.',
                'difficulty' => 'beginner',
                'exercises' => [
                    [
                        'slug' => 'desenvolvimento-militar',
                        'sets' => 4,
                        'reps' => 10,
                        'weight' => 20,
                        'rest_seconds' => 90,
                        'order' => 1
                    ],
                    [
                        'slug' => 'elevacao-lateral',
                        'sets' => 3,
                        'reps' => 15,
                        'weight' => 8,
                        'rest_seconds' => 45,
                        'order' => 2
                    ],
                    [
                        'slug' => 'elevacao-frontal',
                        'sets' => 3,
                        'reps' => 12,
                        'weight' => 8,
                        'rest_seconds' => 45,
                        'order' => 3
                    ],
                    [
                        'slug' => 'encolhimento',
                        'sets' => 4,
                        'reps' => 15,
                        'weight' => 25,
                        'rest_seconds' => 60,
                        'order' => 4
                    ],
                ]
            ],

            // =========================
            // BRAÇOS
            // =========================
            [
                'name' => 'Treino de Braços',
                'description' => 'Treino para bíceps e tríceps.',
                'difficulty' => 'beginner',
                'exercises' => [
                    [
                        'slug' => 'rosca-direta',
                        'sets' => 4,
                        'reps' => 12,
                        'weight' => 12,
                        'rest_seconds' => 60,
                        'order' => 1
                    ],
                    [
                        'slug' => 'rosca-martelo',
                        'sets' => 3,
                        'reps' => 12,
                        'weight' => 10,
                        'rest_seconds' => 60,
                        'order' => 2
                    ],
                    [
                        'slug' => 'triceps-testa',
                        'sets' => 4,
                        'reps' => 10,
                        'weight' => 15,
                        'rest_seconds' => 60,
                        'order' => 3
                    ],
                    [
                        'slug' => 'triceps-corda',
                        'sets' => 3,
                        'reps' => 15,
                        'weight' => 12,
                        'rest_seconds' => 45,
                        'order' => 4
                    ],
                ]
            ],

            // =========================
            // CORE
            // =========================
            [
                'name' => 'Treino de Core',
                'description' => 'Treino focado em abdômen e estabilização.',
                'difficulty' => 'beginner',
                'exercises' => [
                    [
                        'slug' => 'prancha',
                        'sets' => 3,
                        'reps' => 1,
                        'weight' => null,
                        'rest_seconds' => 45,
                        'order' => 1
                    ],
                    [
                        'slug' => 'abdominal-crunch',
                        'sets' => 4,
                        'reps' => 20,
                        'weight' => null,
                        'rest_seconds' => 30,
                        'order' => 2
                    ],
                    [
                        'slug' => 'elevacao-de-pernas',
                        'sets' => 3,
                        'reps' => 15,
                        'weight' => null,
                        'rest_seconds' => 45,
                        'order' => 3
                    ],
                    [
                        'slug' => 'russian-twist',
                        'sets' => 3,
                        'reps' => 20,
                        'weight' => 5,
                        'rest_seconds' => 30,
                        'order' => 4
                    ],
                ]
            ],
        ];

        foreach ($plans as $planData) {

            $plan = Plan::create([
                'name' => $planData['name'],
                'slug' => Str::slug($planData['name']),
                'description' => $planData['description'],
                'difficulty' => $planData['difficulty'],
                'is_template' => true,
            ]);

            foreach ($planData['exercises'] as $exerciseData) {

                $exercise = Exercise::where(
                    'slug',
                    $exerciseData['slug']
                )->first();

                if (!$exercise) {
                    continue;
                }

                $plan->exercises()->attach($exercise->id, [
                    'sets' => $exerciseData['sets'],
                    'reps' => $exerciseData['reps'],
                    'weight' => $exerciseData['weight'],
                    'rest_seconds' => $exerciseData['rest_seconds'],
                    'order' => $exerciseData['order'],
                ]);
            }
        }
    }
}