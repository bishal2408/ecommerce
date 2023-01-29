<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApproveController extends Controller
{
    public function index()
    {
        $orders = Order::where('merchant_id', Auth::id())
                ->where('order_status', Order::ORDER_ON_PROCESS)
                ->paginate(15);
        return view('merchant.approve.index', compact('orders'));
    }
    public function approveDelivery($id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'order_status' => Order::ORDER_DELIVERED,
        ]);
        if($order->is_paid == Order::NOT_PAID)
        {
            $order->update([
                'is_paid' => Order::PAID_VIA_CASH,
            ]);
        }
        return redirect()->back()->with('approveMessage', 'Product Delievery Approved!!');
    }
}
