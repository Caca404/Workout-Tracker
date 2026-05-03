<?php

use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Mail\Mailable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

uses(RefreshDatabase::class);

it('can register a user', function () {
    $response = $this->postJson('/api/v1/auth/register', [
        'name' => 'Chris',
        'email' => 'chris@test.com',
        'password' => 'Password@123',
        'password_confirmation' => 'Password@123',
    ]);

    $response->assertStatus(201);
});

it('can login', function () {
    $user = User::factory()->create([
        'password' => Hash::make('Password@123')
    ]);

    $response = $this->postJson('/api/v1/auth/login', [
        'email' => $user->email,
        'password' => 'Password@123',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'access_token',
            'expires_in'
        ]);
});

it('fails with invalid credentials', function () {
    $response = $this->postJson('/api/v1/auth/login', [
        'email' => 'fake@test.com',
        'password' => 'WrongPassword@123',
    ]);

    $response->assertStatus(401);
});

it('can logout', function () {
    $user = User::factory()->create([
        'password' => bcrypt('Password@123')
    ]);

    $token = auth('api')->login($user);

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->postJson('/api/v1/logout');

    $response->assertStatus(200);
});


it('can request password reset', function () {
    Notification::fake();

    $user = User::factory()->create();

    $response = $this->postJson('/api/v1/auth/forgot-password', [
        'email' => $user->email,
    ]);

    $response->assertStatus(200);

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
        return !empty($notification->token);
    });
});

it('can reset password', function () {
    $user = User::factory()->create();

    $token = Password::createToken($user);

    $response = $this->postJson('/api/v1/auth/reset-password', [
        'email' => $user->email,
        'token' => $token,
        'password' => 'NewPassword@123',
        'password_confirmation' => 'NewPassword@123',
    ]);

    $response->assertStatus(200);

    expect(Hash::check('NewPassword@123', $user->fresh()->password))->toBeTrue();
});
