<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DisplayController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kitchen', [DisplayController::class, 'kitchen']);
Route::get('/queue', [DisplayController::class, 'queue']);
Route::get('/test-order', [DisplayController::class, 'testOrder']);
Route::get('/kiosk', [DisplayController::class, 'kiosk']);
Route::get('/fitness', [DisplayController::class, 'kioskgym']);
Route::get('/automation', [DisplayController::class, 'kioskauto']);
Route::post('/orders', [DisplayController::class, 'store']);
Route::get('/api/orders', [DisplayController::class, 'fetchOrders']);

Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders/fetch', [OrderController::class, 'index']);
Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus']);
Route::delete('/orders/{order}', [OrderController::class, 'destroy']);
