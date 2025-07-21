<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisplayController extends Controller
{

    public function kitchen() {
        return view('kitchen');
    }

    public function queue() {
        return view('queue');
    }

    public function testOrder() {
        return view('test-order');
    }

    public function kiosk() {
        return view('kiosk');
    }

    public function kioskgym() {
        return view('kioskgym');
    }

    public function kioskauto() {
        return view('auto');
    }

    public function store(Request $request) {
        $orders = Cache::get('orders', []);
        $orders[] = [
            'id' => uniqid('A'),
            'time' => now()->format('h:i A'),
            'status' => 'new',
            'items' => $request->input('items', []),
        ];
        Cache::put('orders', $orders);
        return response()->json(['message' => 'Order placed']);
    }

    public function fetchOrders() {
        $orders = Cache::get('orders', []);
        return response()->json($orders);
    }
}

