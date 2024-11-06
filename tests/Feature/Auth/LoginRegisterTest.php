<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('Allows a user to register then login', function () {
    // Register an user
    $this->postJson('/api/v1/register', [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    // Login with credentials
    $response = $this->postJson('/api/v1/login', [
        'email' => 'johndoe@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(200)->assertJsonStructure(['token', 'type', 'expires']);
});
