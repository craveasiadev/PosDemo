<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $orderNumber = uniqid('A');

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