<?php

use App\Http\Controllers\Customer\CustomerHomeController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Merchant\ApproveController;
use App\Http\Controllers\Merchant\ProductCategoryController;
use App\Http\Controllers\Merchant\ProductSubCategoryController;
use App\Http\Controllers\Merchant\UserDemographicsController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [CustomerHomeController::class, 'index'])->name('user.home');


Auth::routes();

Route::get('/checkrole')->middleware('role');

Route::group(['prefix'=>'merchant', 'as'=>'merchant.', 'middleware'=>'isMerchant'], function(){
    Route::get('home', [HomeController::class, 'index'])->name('home');
    // product category
    Route::resource('category',\App\Http\Controllers\Merchant\ProductCategoryController::class);
    // product sub category
    Route::resource('sub-category',\App\Http\Controllers\Merchant\ProductSubCategoryController::class);
    Route::get('/subCategory/delete/{id}', [ProductSubCategoryController::class, 'singleDelete'])->name('sub-category.delete');
    // merchant settings
    Route::resource('setting',\App\Http\Controllers\Merchant\MerchantSettingController::class);
    // product
    Route::resource('product', \App\Http\Controllers\Merchant\ProductController::class);
    // approve
    Route::get('/approve-order', [ApproveController::class, 'index'])->name('approve.index');
    Route::get('/approve-delivery/{id}', [ApproveController::class, 'approveDelivery'])->name('approve.delivery');

    Route::get('/demographics-analysis', [UserDemographicsController::class, 'index'])->name('user.demographics');

});

Route::get('/subcategories/{id}', [ProductCategoryController::class, 'getSubcategories']);
Route::post('/customerRegister', [CustomerHomeController::class, 'customerRegister'])->name('customerRegister');

Route::group(['prefix'=>'customer', 'as'=>'customer.'], function(){
    Route::get('showProduct/{product}', [CustomerHomeController::class, 'showProductDetail'])->name('showProduct');
    Route::middleware('auth')->group(function(){
        Route::post('/add-cart/{product}', [OrderController::class,  'addProductToCart'])->name('addProductToCart');
        Route::post('/update-quantity/{order}/', [OrderController::class,  'updateProductQuantity'])->name('updateProductQuantity');
        Route::delete('/remove-cart/{order}', [OrderController::class, 'delete'])->name('item.delete');
        Route::post('/update_qty', [OrderController::class, 'updateQty'])->name('update_qty');
        Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
        Route::get('/clear-history', [OrderController::class, 'clearHistory'])->name('clear.history');
        Route::delete('/remove-history/{order}', [OrderController::class, 'deleteHistory'])->name('item.deleteHistory');
        Route::post('/rateProduct', [OrderController::class, 'rateProduct'])->name('rateProduct');

        Route::get('/trackOrders', [CustomerHomeController::class, 'trackOrders'])->name('trackOrders');
        Route::get('/orderHistory', [CustomerHomeController::class, 'orderHistory'])->name('orderHistory');
        Route::get('cart', [CustomerHomeController::class, 'showCart'])->name('show.cart');
    });
    Route::get('/product-category/{id}', [CustomerHomeController::class, 'showCategory'])->name('show.category');

});
Route::get('/products', [CustomerHomeController::class, 'viewAllProduct'])->name('products');

Route::resource('comment',\App\Http\Controllers\Customer\CommentController::class);

Route::get('/verify-payment', [OrderController::class, 'esewaVerification'])->name('esewa.verify');
Route::get('/esewa-success', [OrderController::class, 'esewaSuccess'])->name('esewa.success');
Route::get('/pay-fail', [OrderController::class, 'payFail'])->name('pay.fail');