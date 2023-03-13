<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDemographicsController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $products = Product::whereBetween('updated_at', [$startOfWeek, $endOfWeek])->where('merchant_id', Auth::id())->get();
        $orders = Order::whereBetween('updated_at', [$startOfWeek, $endOfWeek])->get();
        $count = 0;
        $total_sales_count = 0;
        $total_revenue = 0;
        
        foreach($products as $product)
        {
            if($product->purchase_count > $count ){
                $count = $product->purchase_count;
                $data['product_of_the_week'] = $product->name;
                $data['product_of_the_week_unit_sold'] = $product->purchase_count;
            }
            $total_sales_count += $product->purchase_count;
            foreach($orders as $order){
                if($order->product_id == $product->id){
                    $total_revenue += $order->quantity * $product->price;
                }
            }
        }
        $data['total_sales_this_week'] = $total_sales_count;
        $data['total_revene_this_week'] = $total_revenue;
        return view('merchant.demographics.index', compact('data'));
    }
}
