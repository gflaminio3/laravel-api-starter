<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('Allows a user to register', function () {
    $response = $this->postJson('/api/v1/register', [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertStatus(201)->assertJsonStructure(['token']);

    $this->assertDatabaseHas('users', [
        'email' => 'johndoe@example.com',
    ]);
});
