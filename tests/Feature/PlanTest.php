<?php

use App\Models\Plan;
use App\Models\User;
use App\Models\Exercise;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can list user plans and templates', function () {

    $user = User::factory()->create();

    $otherUser = User::factory()->create();

    Plan::factory()->create([
        'user_id' => $user->id,
        'is_template' => false,
    ]);

    Plan::factory()->create([
        'user_id' => null,
        'is_template' => true,
    ]);

    Plan::factory()->create([
        'user_id' => $otherUser->id,
        'is_template' => false,
    ]);

    $token = auth('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->getJson('/api/v1/plans');

    $response->assertStatus(200);

    expect($response->json())->toHaveCount(2);
});

it('can create a plan', function () {

    $user = User::factory()->create();

    $exercise = Exercise::factory()->create();

    $token = auth('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->postJson('/api/v1/plans', [
            'name' => 'Treino A',
            'description' => 'Treino de peito',
            'difficulty' => 'beginner',
            'exercises' => [
                [
                    'id' => $exercise->id,
                    'sets' => 4,
                    'reps' => 10,
                    'weight' => 20,
                ]
            ]
        ]);

    $response->assertStatus(201);

    $this->assertDatabaseHas('plans', [
        'name' => 'Treino A',
        'slug' => 'treino-a',
        'description' => 'Treino de peito',
        'difficulty' => 'beginner'
    ]);

    $this->assertDatabaseHas('exercise_plan', [
        'exercise_id' => $exercise->id,
        'sets' => 4,
        'reps' => 10,
    ]);
});

it('can update a plan', function () {

    $user = User::factory()->create();

    $exercise = Exercise::factory()->create();

    $plan = Plan::factory()->create([
        'user_id' => $user->id,
    ]);

    $token = auth('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->putJson("/api/v1/plans/{$plan->id}", [
            'name' => 'Treino Atualizado',
            'difficulty' => 'advanced',
            'exercises' => [
                [
                    'id' => $exercise->id,
                    'sets' => 5,
                    'reps' => 12,
                    'weight' => 30,
                ]
            ]
        ]);

    $response->assertStatus(200);

    $this->assertDatabaseHas('plans', [
        'id' => $plan->id,
        'name' => 'Treino Atualizado',
        'difficulty' => 'advanced',
    ]);

    $this->assertDatabaseHas('exercise_plan', [
        'exercise_id' => $exercise->id,
        'plan_id' => $plan->id,
        'sets' => 5,
        'reps' => 12,
    ]);
});

it('can partially update a plan', function () {

    $user = User::factory()->create();

    $plan = Plan::factory()->create([
        'user_id' => $user->id,
        'name' => 'Treino Antigo',
    ]);

    $token = auth('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->patchJson("/api/v1/plans/{$plan->id}", [
            'name' => 'Novo Nome'
        ]);

    $response->assertStatus(200);

    $this->assertDatabaseHas('plans', [
        'id' => $plan->id,
        'name' => 'Novo Nome',
        'slug' => 'novo-nome',
    ]);
});

it('can delete a plan', function () {

    $user = User::factory()->create();

    $plan = Plan::factory()->create([
        'user_id' => $user->id,
    ]);

    $token = auth('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->deleteJson("/api/v1/plans/{$plan->id}");

    $response->assertStatus(200);

    $this->assertDatabaseMissing('plans', [
        'id' => $plan->id,
    ]);
});