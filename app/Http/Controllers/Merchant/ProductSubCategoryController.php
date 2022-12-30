<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSubCategoryRequest;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::where('merchant_id', Auth::user()->id)->get();
        // dd(count($categories));
        if(count($categories) != 0){
            foreach($categories as $category){
                $cat = ProductCategory::findorFail($category->id);
                $subCategory[] = $cat->subcategories;
            }
            return view('merchant.sub-category.index', compact('categories', 'subCategory'));
        }
        else{
            $subCategory = null;
            return view('merchant.sub-category.index', compact('categories', 'subCategory'));

        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductSubCategoryRequest $request)
    {
        $request->validated();
        $attributes = [
            'name' => $request->input('name'),
            'category_id'=> $request->get('category'),
        ];
        ProductSubCategory::create($attributes);
        return redirect()->back()->with('successMessage', 'Sub Category Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
 
        ProductSubCategory::where('category_id', $id)->delete();
        ProductCategory::where('id', $id)->delete();
        return redirect()->back();
    }

    public function singleDelete($id)
    {
        $subCategory = ProductSubCategory::findorFail($id);
        $subCategory->delete();
        return redirect()->back();
    }
}
