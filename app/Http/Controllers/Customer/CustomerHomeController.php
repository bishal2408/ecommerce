<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\UploadFileTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class CustomerHomeController extends Controller
{
    // for using file trait
    use UploadFileTrait;
    // to register user
    use RegistersUsers;

    private $user_photo_path;
    // constructor
    public function __construct()
    {   
        $this->user_photo_path = public_path('upload/user/photo/');
    }

    // user landing page
    public function index()
    {
        $hot_deals = Product::select('id', 'name', 'description', 'price', 'photo')->take(7)->get();
        if(Auth::user()!= null){
            $cart_count = Order::where('user_id', Auth::user()->id)
                    ->where('on_cart', Order::ADD_TO_CART)
                    ->where('order_status', null)
                    ->count();
            return view('welcome', compact('hot_deals', 'cart_count'));
        }
        return view('welcome', compact('hot_deals')); 
    }

    // for cutomer registration 
    protected function guard()
    {
        return Auth::guard();
    }
    
    public function customerRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data = $request->all();
        if($request->file('photo')!= null)
        {
            $photoName = $this->uploadFile($request->file('photo'), $this->user_photo_path);
            $data['photo'] = $photoName;
        }
        $data['password'] = Hash::make($request->get('password'));
        $user = User::create($data);
        $this->guard()->login($user);
        return redirect('/checkrole');
    }

    public function showProduct(Product $product)
    {
        $related_products = Product::select('id', 'name', 'description', 'price', 'photo')->take(4)->get();
        if(Auth::user() != null){
            $cart_count = Order::where('user_id', Auth::user()->id)
            ->where('on_cart', Order::ADD_TO_CART)
            ->where('order_status', null)
            ->count();
            $existingCartItem = Order::where('user_id', Auth::user()->id)
                            ->where('product_id', $product->id)
                            ->where('on_cart', Order::ADD_TO_CART)
                            ->first();
            return view('customer.showProduct', compact('product', 'related_products', 'existingCartItem', 'cart_count'));
        }
        $existingCartItem = null;
        return view('customer.showProduct', compact('product', 'related_products', 'existingCartItem'));
    }
    
    public function showCart()
    {
        $cart = Order::where('user_id', Auth::user()->id)
                    ->where('on_cart', Order::ADD_TO_CART)
                    ->where('order_status', null);
        $address = UserAddress::where('user_id', Auth::user()->id)->first();
        $cart_count = $cart->count();
        $cart_items = $cart->get();
        return  view('customer.showCart', compact('cart_count', 'cart_items', 'address'));
    }

    public function trackOrders()
    {
        $cart_count = Order::where('user_id', Auth::user()->id)
            ->where('on_cart', Order::ADD_TO_CART)
            ->where('order_status', null)
            ->count();
        $track_order = Order::where('user_id', Auth::user()->id)
                    ->where('order_status', Order::ORDER_ON_PROCESS);
        $order_count = $track_order->count();
        $orders = $track_order->latest()->get();
        return view('customer.trackOrder', compact('orders', 'cart_count', 'order_count'));
    }
}
