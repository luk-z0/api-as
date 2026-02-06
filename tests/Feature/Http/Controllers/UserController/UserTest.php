<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Create User API', function () {

    test('permit create new user in API', function () {
        $data = [
            'name' => 'João Silva',
            'email' => 'joao@email.com',
            'password' => '12345678',
        ];

        $response = $this->postJson('/api/users', $data);

        $response->assertStatus(201);

        expect(User::where('email', $data['email'])->exists())->toBeTrue();
    });

    test('validate create with wrong values', function (string $name, $email, string $password, array $expectedErrors) {

        if ($email === 'duplicate@example.com') {
            User::factory()->create(['email' => 'duplicate@example.com']);
        }

        $response = $this->postJson('/api/users', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        expect($response->status())->toBe(422);

    })->with('user_registration_validation_scenarios');
});

describe('View User API', function () {
    test('permit view user in API', function () {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");

        $response->assertJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);

        expect($response->status())->toBe(200);
    });

    // test('return 404 when user not found', function () {
    //     $response = $this->getJson('/api/users/999');

    //     $response->assertStatus(404)->assertJson([
    //         'error' => 'User not found',
    //     ]);
    // });
});
