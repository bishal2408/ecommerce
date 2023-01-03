<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Merchant\ProductCategoryController;
use App\Http\Controllers\Merchant\ProductSubCategoryController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix'=>'merchant', 'as'=>'merchant.'], function(){
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
});
Route::get('/subcategories/{id}', [ProductCategoryController::class, 'getSubcategories']);

