<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'amount' => $this->faker->randomFloat(2, 10000, 500000),
            'status' => 'PENDING', // ⚠️ HARUS SESUAI ENUM
        ];
    }

    public function paid()
    {
        return $this->state(fn () => [
            'status' => 'PAID',
        ]);
    }

    public function cancelled()
    {
        return $this->state(fn () => [
            'status' => 'CANCELLED',
        ]);
    }
}
