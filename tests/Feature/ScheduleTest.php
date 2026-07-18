<?php

use App\Models\Plan;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can list user schedules ordered by date', function () {

    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    $plan = Plan::factory()->create([
        'user_id' => $user->id,
    ]);

    $otherPlan = Plan::factory()->create([
        'user_id' => $otherUser->id,
    ]);

    Schedule::factory()->create([
        'user_id' => $user->id,
        'plan_id' => $plan->id,
        'scheduled_at' => now()->addDays(2),
    ]);

    Schedule::factory()->create([
        'user_id' => $user->id,
        'plan_id' => $plan->id,
        'scheduled_at' => now()->addDay(),
    ]);

    Schedule::factory()->create([
        'user_id' => $otherUser->id,
        'plan_id' => $otherPlan->id,
        'scheduled_at' => now(),
    ]);

    $token = auth('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->getJson('/api/v1/schedules');

    $response->assertStatus(200);

    expect($response->json())->toHaveCount(2);

    expect($response->json()[0]['scheduled_at'])
        ->toBeLessThan($response->json()[1]['scheduled_at']);
});

it('can create a schedule', function () {

    $user = User::factory()->create();

    $plan = Plan::factory()->create([
        'user_id' => $user->id,
    ]);

    $token = auth('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->postJson('/api/v1/schedules', [
            'plan_id' => $plan->id,
            'scheduled_at' => now()->addDay()->toDateTimeString(),
        ]);

    $response->assertStatus(201);

    $this->assertDatabaseHas('schedules', [
        'user_id' => $user->id,
        'plan_id' => $plan->id,
    ]);
});

it('can update a schedule', function () {

    $user = User::factory()->create();

    $plan = Plan::factory()->create([
        'user_id' => $user->id,
    ]);

    $schedule = Schedule::factory()->create([
        'user_id' => $user->id,
        'plan_id' => $plan->id,
    ]);

    $newDate = now()->addWeek()->toDateTimeString();

    $token = auth('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->putJson("/api/v1/schedules/{$schedule->id}", [
            'plan_id' => $plan->id,
            'scheduled_at' => $newDate,
        ]);

    $response->assertStatus(200);

    $this->assertDatabaseHas('schedules', [
        'id' => $schedule->id,
        'scheduled_at' => $newDate,
    ]);
});

it('can delete a schedule', function () {

    $user = User::factory()->create();

    $plan = Plan::factory()->create([
        'user_id' => $user->id,
    ]);

    $schedule = Schedule::factory()->create([
        'user_id' => $user->id,
        'plan_id' => $plan->id,
    ]);

    $token = auth('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->deleteJson("/api/v1/schedules/{$schedule->id}");

    $response->assertStatus(200);

    $this->assertDatabaseMissing('schedules', [
        'id' => $schedule->id,
    ]);
});

it('cannot create a schedule in the past', function () {

    $user = User::factory()->create();

    $plan = Plan::factory()->create([
        'user_id' => $user->id,
    ]);

    $token = auth('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->postJson('/api/v1/schedules', [
            'plan_id' => $plan->id,
            'scheduled_at' => now()->subHour()->toISOString(),
        ]);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors([
        'scheduled_at'
    ]);
});

it('cannot update a schedule to a past date', function () {

    $user = User::factory()->create();

    $plan = Plan::factory()->create([
        'user_id' => $user->id,
    ]);

    $schedule = Schedule::factory()->create([
        'user_id' => $user->id,
        'plan_id' => $plan->id,
    ]);

    $token = auth('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->putJson("/api/v1/schedules/{$schedule->id}", [
            'plan_id' => $plan->id,
            'scheduled_at' => now()->subDay()->toISOString(),
        ]);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors([
        'scheduled_at'
    ]);
});

it('lists schedules in chronological order', function () {

    $user = User::factory()->create();

    $plan = Plan::factory()->create([
        'user_id' => $user->id,
    ]);

    Schedule::factory()->create([
        'user_id' => $user->id,
        'plan_id' => $plan->id,
        'scheduled_at' => now()->addDays(5),
    ]);

    Schedule::factory()->create([
        'user_id' => $user->id,
        'plan_id' => $plan->id,
        'scheduled_at' => now()->addDay(),
    ]);

    Schedule::factory()->create([
        'user_id' => $user->id,
        'plan_id' => $plan->id,
        'scheduled_at' => now()->addDays(3),
    ]);

    $token = auth('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->getJson('/api/v1/schedules');

    $response->assertStatus(200);

    $dates = collect($response->json())
        ->pluck('scheduled_at')
        ->map(fn($date) => strtotime($date))
        ->values();

    expect($dates->values()->all())
        ->toBe($dates->sort()->values()->all());
});

it('only lists schedules from the authenticated user', function () {

    $user = User::factory()->create();

    $otherUser = User::factory()->create();

    $plan = Plan::factory()->create([
        'user_id' => $user->id,
    ]);

    $otherPlan = Plan::factory()->create([
        'user_id' => $otherUser->id,
    ]);

    Schedule::factory()->create([
        'user_id' => $user->id,
        'plan_id' => $plan->id,
    ]);

    Schedule::factory()->create([
        'user_id' => $otherUser->id,
        'plan_id' => $otherPlan->id,
    ]);

    $token = auth('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->getJson('/api/v1/schedules');

    $response->assertStatus(200);

    expect($response->json())->toHaveCount(1);
});

it('cannot schedule another users plan', function () {

    $user = User::factory()->create();

    $otherUser = User::factory()->create();

    $plan = Plan::factory()->create([
        'user_id' => $otherUser->id,
    ]);

    $token = auth('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->postJson('/api/v1/schedules', [
            'plan_id' => $plan->id,
            'scheduled_at' => now()->addDay()->toISOString(),
        ]);

    $response->assertForbidden();
});
