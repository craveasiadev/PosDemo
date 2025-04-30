<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_number', 'status', 'payment_method'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
