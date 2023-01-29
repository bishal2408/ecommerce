<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const ADD_TO_CART = 1;
    const REMOVE_FROM_CART = 0;
    const ORDER_ON_PROCESS = 'Onprocess';
    const ORDER_DELIVERED = 'Delivered';
    const PAID_VIA_ESEWA = 'Paid via e-sewa';
    const NOT_PAID = 'Not paid';
    const PAID_VIA_CASH = "Paid via cash on delivery";

    use HasFactory;
    protected $fillable = [
        'user_id', 'product_id', 'merchant_id', 'quantity',
        'on_cart', 'order_status', 'is_paid',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
