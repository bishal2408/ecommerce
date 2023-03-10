<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuantityRequest;
use App\Http\Requests\UserAddressRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Rating;
use App\Models\UserAddress;
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

    public function checkout(UserAddressRequest $request)
    {
        $request->validated();
        $address = UserAddress::where('user_id', Auth::user()->id)->first();
        if($address==null)
        {
            UserAddress::create([
                'user_id' => Auth::user()->id,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);
        }
        else{
            $address->update([
                'address' => $request->address,
                'phone' => $request->phone,
            ]);
        }
        $orders = Order::where('user_id', Auth::user()->id)
                    ->where('on_cart', Order::ADD_TO_CART)
                    ->where('order_status', null)
                    ->get();
        $items = '';
        foreach($orders as $order)
        {
            $itemId = strval($order->product->id).',';
            $items .= $itemId;
            $product = Product::findOrFail($itemId);
            $total_count = $product->purchase_count + $order->quantity;
            $order->update([
                'on_cart' => Order::REMOVE_FROM_CART,
                'order_status'=> Order::ORDER_ON_PROCESS,
            ]);
            
            $product->update([
                'purchase_count' => $total_count,
            ]);
        }
        $items = substr($items, 0, -1);
        Purchase::create([
            'items' => $items,
        ]);
        return redirect()->back()->with('orderMessage', 'Your Orders has been placed!!');
    }
    public function delete(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('deleteMessage', 'Successfully removed from the order list!');
    }
    public function deleteHistory(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('deleteMessage', 'Purchase history removed!!');
    }
    public function clearHistory()
    {
        $orders = Order::where('user_id', Auth::id())
                    ->where('order_status', Order::ORDER_DELIVERED)
                    ->get();
        foreach($orders as $order)
        {
            $order->delete();
        }
        return redirect()->back()->with('deleteMessage', 'Order History Cleared!!');
    }

    public function updateQty(Request $request)
    {
        $order = Order::find($request->item_id);
        $order->quantity = $request->qty;
        $order->save();
        return response()->json(["status" => "ok"]);
    }
    
    public function rateProduct(Request $request)
    {
        $rating = Rating::where('user_id', Auth::user()->id)
                        ->where('product_id', $request->product_id)
                        ->first();
        if($rating === null)
        {
            Rating::create([
                'user_id' => Auth::user()->id,
                'rating' => $request->rating,
                'product_id' => $request->product_id,
            ]);
        }
        else {
            $rating->update([
                'rating' => $request->rating,
            ]);
        }
        return response()->json(["status" => "ok"]);
    }

    public function esewaVerification(Request $request)
    {
        $url = "https://uat.esewa.com.np/epay/transrec";
        $data =[
            'amt'=> 10,
            'rid'=> $request->get('refId'),
            'pid'=> $request->get('oid'),
            'scd'=> 'EPAYTEST'
        ];
        
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        
        return redirect()->route('esewa.success');
        
    }

    public function payFail()
    {
        dd('payment fail');
    }

    public function esewaSuccess()
    {
        $orders = Order::where('user_id', Auth::user()->id)
                    ->where('on_cart', Order::ADD_TO_CART)
                    ->where('order_status', null)
                    ->get();
        $items = '';
        foreach($orders as $order)
        {
            $itemId = strval($order->product->id).',';
            $items .= $itemId;
            $product = Product::findOrFail($itemId);
            $total_count = $product->purchase_count + $order->quantity;
            $order->update([
                'on_cart' => Order::REMOVE_FROM_CART,
                'order_status'=> Order::ORDER_ON_PROCESS,
                'is_paid' => Order::PAID_VIA_ESEWA
            ]);
            
            $product->update([
                'purchase_count' => $total_count,
            ]);
        }
        $items = substr($items, 0, -1);
        Purchase::create([
            'items' => $items,
        ]);
        return redirect()->route('customer.show.cart')->with('orderMessage', 'Your Orders has been placed!!');
    }
}
