<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\UploadFileTrait;

class ProductController extends Controller
{
    use UploadFileTrait;
    private $product_photo_path;
    public function __construct()
    {
        $this->product_photo_path = public_path('upload/product/photo/');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('merchant_id', Auth::user()->id)->latest()->get();
        return view('merchant.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= ProductCategory::where('merchant_id', Auth::user()->id)->get();
        return view('merchant.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $request->validated();
        $data = $request->all();
        $photoName = $this->uploadFile($request->file('photo'), $this->product_photo_path);
        $data['photo'] = $photoName;
        $data['category_id']= $request->get('category');
        $data['sub_category_id']= $request->get('sub_category');
        Product::create($data);
        return redirect()->route('merchant.product.create')->with('successMessage', 'Product Added Sucessfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('merchant.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories= ProductCategory::where('merchant_id', Auth::user()->id)->get();
        $subcategories = ProductSubCategory::where('category_id', $product->category_id)->get();
        return view('merchant.product.edit', compact('product', 'categories', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest  $request
     * @param Product  $prodyct
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $request->validated();
        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($request->get('old_photo') != null) {  
                $this->removePhysicalFile($request->get('old_photo'), $this->product_photo_path);
            }
            $photoName = $this->uploadFile($request->file('photo'), $this->product_photo_path);
            $data['photo'] = $photoName;
        }
        // return $data;
        $product->update($data);
        $product->category_id = $data['category'];
        $product->sub_category_id = $data['sub_category'];
        $product->save();
        return redirect()->route('merchant.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->removePhysicalFile($product->photo, $this->product_photo_path);
        $product->delete();
        return redirect()->back()->with('deleteMessage', 'Product Deleted!!');
    }
}
