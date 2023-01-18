<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\UploadFileTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    // function that returns a collection of similar products that logged in user might like using similarity approach
    public function CosineSimilarProducts()
    {
        // retrieve the ratings of the logged-in user from the rating table
        $loggedInUserRatings = Rating::where('user_id', Auth::id())->get();

        //  use the DB::raw() method to retrieve the average rating of the products that the logged-in user has not rated yet
        $averageProductRatings = DB::table('ratings')
                ->select(DB::raw('product_id, AVG(rating) as avg_rating'))
                ->whereNotIn('product_id', $loggedInUserRatings->pluck('product_id'))
                ->groupBy('product_id')
                ->get();
        // similarity algorithm to calculate the similarity between the logged-in user's ratings and the ratings of other users
        $similarityScores = [];
        foreach($averageProductRatings as $rating)
        {
            $productId = $rating->product_id;
            $otherUsersRatings = Rating::where('product_id', $productId)->where('user_id', '!=', Auth::id())->get();
            $dotProduct = 0;
            $magnitudeA = 0;
            $magnitudeB = 0;

            //Calculating dot product
            foreach($loggedInUserRatings as $loggedInUserRating)
            {
                foreach($otherUsersRatings as $otherUsersRating)
                {
                    if($loggedInUserRating->product_id != $otherUsersRating->product_id)
                    {
                        $dotProduct += $loggedInUserRating->rating * $otherUsersRating->rating;
                        $magnitudeA += pow($loggedInUserRating->rating, 2);
                        $magnitudeB += pow($otherUsersRating->rating, 2);
                    }
                }
            }
            if($magnitudeA!=0 && $magnitudeB != 0) {
                $similarityScore = $dotProduct / sqrt($magnitudeA * $magnitudeB);
                $similarityScores[$productId] = $similarityScore;
            }
            
        }
        //  order the products by their cosine similarity score and return the top N products to the user as recommendations
        arsort($similarityScores);
        // dd($similarityScores);
        $recommendedProductIds = array_keys($similarityScores);
        $recommendedProducts = Product::whereIn('id', $recommendedProductIds)->take(4)->get();
        return  $recommendedProducts;
    }

    // user landing page
    public function index()
    {
        $hot_deals = Product::select('id', 'name', 'description', 'price', 'photo')->take(6)->get();
        if(Auth::user()!= null){
            $cosineRecommendations = $this->CosineSimilarProducts();
            $cart_count = Order::where('user_id', Auth::user()->id)
                    ->where('on_cart', Order::ADD_TO_CART)
                    ->where('order_status', null)
                    ->count();
            return view('welcome', compact('hot_deals', 'cart_count', 'cosineRecommendations'));
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
    // show product detail
    public function showProductDetail(Product $product)
    {
        $related_products = Product::select('id', 'name', 'description', 'price', 'photo')->take(4)->get();
        if(Auth::user() != null){
            $cart_count = Order::where('user_id', Auth::user()->id)
            ->where('on_cart', Order::ADD_TO_CART)
            ->where('order_status', null)
            ->count();
            $user_rating = Rating::where('user_id', Auth::user()->id)
                            ->where('product_id', $product->id)
                            ->pluck('rating')
                            ->first();
            $existingCartItem = Order::where('user_id', Auth::user()->id)
                            ->where('product_id', $product->id)
                            ->where('on_cart', Order::ADD_TO_CART)
                            ->first();
            return view('customer.showProduct', compact('product', 'related_products', 'existingCartItem', 'cart_count', 'user_rating'));
        }
        $existingCartItem = null;
        $user_rating = null;
        return view('customer.showProduct', compact('product', 'related_products', 'existingCartItem', 'user_rating'));
    }
    // show cart page
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
    // track order page
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
    // show all products
    public function viewAllProduct()
    {
        $products = Product::get();
        $cart_count = Order::where('user_id', Auth::user()->id)
        ->where('on_cart', Order::ADD_TO_CART)
        ->where('order_status', null)
        ->count();
        return view('customer.allProduct', compact('products', 'cart_count'));
    }
}
