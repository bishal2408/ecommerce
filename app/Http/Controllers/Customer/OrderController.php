<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuantityRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function addProductToCart(QuantityRequest $request, Product $product)
    {
        $request->validated();
        Order::create([
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
            'merchant_id' => $product->merchant_id,
            'quantity' => $request->quantity,
            'on_cart' => Order::ADD_TO_CART
        ]);

        return redirect()->back()->with('successMessage', "Product added to cart!");
    }

    public function updateProductQuantity(QuantityRequest $request, Order $order)
    {
        $request->validated();
        $order = Order::where('user_id', Auth::user()->id)
            ->where('id', $order->id)
            ->where('order_status', null)
            ->first();
        $order->update([
            'quantity' => $request->quantity,
        ]);
        return redirect()->back()->with('editMessage', "Product quanity updated!");
    }


    public function updateQty(Request $request)
    {
        $order = Order::find($request->item_id);
        $order->quantity = $request->qty;
        $order->save();
        return response()->json(["status" => "ok"]);
    }

    public function delete(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('deleteMessage', 'Successfully removed from the cart!');
    }
}
