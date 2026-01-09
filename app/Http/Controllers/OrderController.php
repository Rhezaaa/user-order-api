<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function indexByUser($userId, Request $request)
    {
        $user = User::findOrFail($userId);
        $perPage = $request->get('per_page', 10);
        $orders = $user->orders()->paginate($perPage);

        return response()->json($orders);
    }

    public function store($userId, Request $request)
    {
        $user = User::findOrFail($userId);

        // Business Rule: only 1 order PENDING
        if ($user->orders()->where('status', Order::STATUS_PENDING)->exists()) {
            throw ValidationException::withMessages([
                'error' => 'User already has a pending order. Please complete or cancel it first.'
            ]);
        }

        $request->validate([
            'amount' => 'required|numeric|gt:0',
        ]);

        $order = $user->orders()->create([
            'amount' => $request->amount,
            'status' => Order::STATUS_PENDING,
        ]);

        return response()->json($order, 201);
    }


    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order);
    }

    public function updateStatus($id, Request $request)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required|in:' . implode(',', [
                Order::STATUS_PAID,
                Order::STATUS_CANCELLED,
            ]),
        ]);

        // Business Rule: status final tidak boleh diubah
        if ($order->status !== Order::STATUS_PENDING) {
            return response()->json([
                'message' => 'Order status can no longer be changed.'
            ], 422);
        }

        $order->update([
            'status' => $request->status
        ]);

        return response()->json($order);
    }

}