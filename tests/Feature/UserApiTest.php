<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_user()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'Ananda',
            'email' => 'ananda@example.com'
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'name' => 'Ananda',
                     'email' => 'ananda@example.com'
                 ]);
    }
}