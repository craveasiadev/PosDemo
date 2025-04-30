<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $orderNumber = strtoupper(substr(uniqid(mt_rand(), true), -4));

// Check if the generated order number already exists in the database
while (Order::where('order_number', $orderNumber)->exists()) {
    // If it exists, generate a new one
    $orderNumber = strtoupper(substr(uniqid(mt_rand(), true), -4));
}

// Now create the order with the unique order number
$order = Order::create([
    'order_number' => $orderNumber,
    'payment_method' => $request->input('payment_method'),
]);

        foreach ($request->input('items', []) as $item) {
            $order->items()->create([
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['totalPrice'],
                'options' => $item['options'] ?? [],
            ]);
        }

        return response()->json(['message' => 'Order placed', 'order_number' => $orderNumber]);
    }

    public function index()
    {
        return Order::with('items')->latest()->get();
    }

    public function updateStatus(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->status = $request->input('status');
        $order->save();

        return response()->json(['message' => 'Order status updated']);
    }

    public function destroy(Order $order)
{
    $order->delete();

    return response()->json(['message' => 'Order deleted']);
}

}