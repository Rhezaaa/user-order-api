<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderBusinessRuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_have_multiple_pending_orders()
    {
        $user = User::factory()->create();

        Order::factory()->create([
            'user_id' => $user->id,
            'status' => Order::STATUS_PENDING,
        ]);

        $response = $this->postJson("/api/users/{$user->id}/orders", [
            'amount' => 100,
        ]);

        $response->assertStatus(422)
                ->assertJsonFragment([
                    'message' => 'User already has a pending order. Please complete or cancel it first.',
                ]);
    }

}