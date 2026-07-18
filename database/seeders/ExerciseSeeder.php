<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Exercise;
use App\Models\MuscleGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exercises = [

            // =========================
            // PEITO
            // =========================
            [
                'name' => 'Supino Reto',
                'description' => 'Exercício composto para desenvolvimento do peitoral.',
                'categories' => ['forca'],
                'muscles' => ['peito', 'ombros', 'bracos']
            ],
            [
                'name' => 'Supino Inclinado',
                'description' => 'Foco na parte superior do peitoral.',
                'categories' => ['forca'],
                'muscles' => ['peito', 'ombros', 'bracos']
            ],
            [
                'name' => 'Crucifixo',
                'description' => 'Exercício isolado para peitoral.',
                'categories' => ['forca'],
                'muscles' => ['peito']
            ],
            [
                'name' => 'Flexão de Braço',
                'description' => 'Exercício utilizando peso corporal.',
                'categories' => ['forca'],
                'muscles' => ['peito', 'core', 'bracos']
            ],
            [
                'name' => 'Crossover',
                'description' => 'Movimento de adução do peitoral.',
                'categories' => ['forca'],
                'muscles' => ['peito']
            ],

            // =========================
            // COSTAS
            // =========================
            [
                'name' => 'Barra Fixa',
                'description' => 'Exercício composto para dorsais.',
                'categories' => ['forca'],
                'muscles' => ['costas', 'bracos']
            ],
            [
                'name' => 'Remada Curvada',
                'description' => 'Fortalecimento da musculatura dorsal.',
                'categories' => ['forca'],
                'muscles' => ['costas', 'bracos']
            ],
            [
                'name' => 'Puxada Frontal',
                'description' => 'Exercício para largura das costas.',
                'categories' => ['forca'],
                'muscles' => ['costas', 'bracos']
            ],
            [
                'name' => 'Levantamento Terra',
                'description' => 'Movimento composto para cadeia posterior.',
                'categories' => ['forca'],
                'muscles' => ['costas', 'pernas', 'core']
            ],
            [
                'name' => 'Face Pull',
                'description' => 'Fortalecimento posterior de ombros e costas.',
                'categories' => ['forca', 'mobilidade'],
                'muscles' => ['costas', 'ombros']
            ],

            // =========================
            // PERNAS
            // =========================
            [
                'name' => 'Agachamento Livre',
                'description' => 'Exercício composto para pernas.',
                'categories' => ['forca'],
                'muscles' => ['pernas', 'core']
            ],
            [
                'name' => 'Leg Press',
                'description' => 'Exercício para quadríceps e glúteos.',
                'categories' => ['forca'],
                'muscles' => ['pernas']
            ],
            [
                'name' => 'Cadeira Extensora',
                'description' => 'Isolamento de quadríceps.',
                'categories' => ['forca'],
                'muscles' => ['pernas']
            ],
            [
                'name' => 'Mesa Flexora',
                'description' => 'Isolamento de posteriores.',
                'categories' => ['forca'],
                'muscles' => ['pernas']
            ],
            [
                'name' => 'Elevação de Panturrilha',
                'description' => 'Fortalecimento de panturrilhas.',
                'categories' => ['forca'],
                'muscles' => ['panturrilhas']
            ],

            // =========================
            // OMBROS
            // =========================
            [
                'name' => 'Desenvolvimento Militar',
                'description' => 'Exercício composto para ombros.',
                'categories' => ['forca'],
                'muscles' => ['ombros', 'bracos']
            ],
            [
                'name' => 'Elevação Lateral',
                'description' => 'Isolamento da parte lateral do ombro.',
                'categories' => ['forca'],
                'muscles' => ['ombros']
            ],
            [
                'name' => 'Elevação Frontal',
                'description' => 'Fortalecimento frontal do ombro.',
                'categories' => ['forca'],
                'muscles' => ['ombros']
            ],
            [
                'name' => 'Arnold Press',
                'description' => 'Variação do desenvolvimento.',
                'categories' => ['forca'],
                'muscles' => ['ombros', 'bracos']
            ],
            [
                'name' => 'Encolhimento',
                'description' => 'Trabalho de trapézio.',
                'categories' => ['forca'],
                'muscles' => ['ombros', 'costas']
            ],

            // =========================
            // BRAÇOS
            // =========================
            [
                'name' => 'Rosca Direta',
                'description' => 'Exercício para bíceps.',
                'categories' => ['forca'],
                'muscles' => ['bracos']
            ],
            [
                'name' => 'Rosca Martelo',
                'description' => 'Fortalecimento de bíceps e antebraço.',
                'categories' => ['forca'],
                'muscles' => ['bracos']
            ],
            [
                'name' => 'Tríceps Testa',
                'description' => 'Exercício isolado para tríceps.',
                'categories' => ['forca'],
                'muscles' => ['bracos']
            ],
            [
                'name' => 'Tríceps Corda',
                'description' => 'Fortalecimento de tríceps.',
                'categories' => ['forca'],
                'muscles' => ['bracos']
            ],
            [
                'name' => 'Rosca Concentrada',
                'description' => 'Isolamento de bíceps.',
                'categories' => ['forca'],
                'muscles' => ['bracos']
            ],

            // =========================
            // CORE
            // =========================
            [
                'name' => 'Prancha',
                'description' => 'Exercício isométrico para core.',
                'categories' => ['mobilidade'],
                'muscles' => ['core']
            ],
            [
                'name' => 'Abdominal Crunch',
                'description' => 'Fortalecimento abdominal.',
                'categories' => ['forca'],
                'muscles' => ['core']
            ],
            [
                'name' => 'Elevação de Pernas',
                'description' => 'Exercício abdominal inferior.',
                'categories' => ['forca'],
                'muscles' => ['core']
            ],
            [
                'name' => 'Russian Twist',
                'description' => 'Movimento rotacional para abdômen.',
                'categories' => ['mobilidade'],
                'muscles' => ['core']
            ],
            [
                'name' => 'Mountain Climber',
                'description' => 'Exercício funcional e cardiovascular.',
                'categories' => ['cardio'],
                'muscles' => ['core', 'pernas']
            ],

            // =========================
            // CARDIO
            // =========================
            [
                'name' => 'Corrida',
                'description' => 'Atividade cardiovascular.',
                'categories' => ['cardio'],
                'muscles' => ['pernas', 'core']
            ],
            [
                'name' => 'Pular Corda',
                'description' => 'Exercício cardiovascular intenso.',
                'categories' => ['cardio'],
                'muscles' => ['pernas', 'panturrilhas']
            ],
            [
                'name' => 'Burpee',
                'description' => 'Exercício funcional completo.',
                'categories' => ['cardio'],
                'muscles' => ['pernas', 'core', 'bracos']
            ],
            [
                'name' => 'Bicicleta Ergométrica',
                'description' => 'Treino cardiovascular de baixo impacto.',
                'categories' => ['cardio'],
                'muscles' => ['pernas']
            ],
            [
                'name' => 'Polichinelo',
                'description' => 'Exercício aeróbico funcional.',
                'categories' => ['cardio'],
                'muscles' => ['pernas', 'ombros']
            ],

            // =========================
            // MOBILIDADE
            // =========================
            [
                'name' => 'Alongamento de Quadril',
                'description' => 'Melhora da mobilidade do quadril.',
                'categories' => ['mobilidade'],
                'muscles' => ['quadril']
            ],
            [
                'name' => 'Alongamento de Ombros',
                'description' => 'Mobilidade articular de ombros.',
                'categories' => ['mobilidade'],
                'muscles' => ['ombros']
            ],
            [
                'name' => 'Mobilidade Torácica',
                'description' => 'Exercício para coluna torácica.',
                'categories' => ['mobilidade'],
                'muscles' => ['costas', 'core']
            ],
            [
                'name' => 'Alongamento Posterior',
                'description' => 'Alongamento da cadeia posterior.',
                'categories' => ['mobilidade'],
                'muscles' => ['pernas', 'costas']
            ],
            [
                'name' => 'Rotação de Tronco',
                'description' => 'Exercício de mobilidade do tronco.',
                'categories' => ['mobilidade'],
                'muscles' => ['core']
            ],
        ];

        foreach ($exercises as $exerciseData) {

            $exercise = Exercise::create([
                'name' => $exerciseData['name'],
                'slug' => Str::slug($exerciseData['name']),
                'description' => $exerciseData['description'],
            ]);

            $categoryIds = Category::whereIn(
                'slug',
                $exerciseData['categories']
            )->pluck('id');

            $muscleIds = MuscleGroup::whereIn(
                'slug',
                $exerciseData['muscles']
            )->pluck('id');

            $exercise->categories()->attach($categoryIds);

            $exercise->muscleGroups()->attach($muscleIds);
        }
    }
}