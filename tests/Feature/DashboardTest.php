<?php

use App\Models\User;
use App\Models\Note;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guests are redirected to the login page', function () {
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    Note::Factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->get('/dashboard');
    $response->assertStatus(302);
});