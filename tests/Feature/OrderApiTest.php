<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_order()
    {
        $user = User::factory()->create();

        $response = $this->postJson("/api/users/{$user->id}/orders", [
            'amount' => 150000,
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'id',
                     'user_id',
                     'amount',
                     'status',
                     'created_at',
                 ]);

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'status' => 'PENDING',
        ]);
    }
}
