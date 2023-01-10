<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const ADD_TO_CART = 1;
    const ORDER_ON_PROCESS = 'Onprocess';
    const ORDER_DELIVERED = 'Delivered';
    use HasFactory;
    protected $fillable = [
        'user_id', 'product_id', 'merchant_id', 'quantity',
        'on_cart', 'order_status',
    ];
}
