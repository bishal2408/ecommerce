<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'merchant_id',
        'category_id',
        'sub_category_id',
        'description',
        'photo',
        'price',
        'stock_quantity',
    ];
    
    protected $appends = ['product_photo'];
    public function getProductPhotoAttribute(){
        return asset('upload/product/photo/')."/".$this->photo;
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(ProductSubCategory::class, 'sub_category_id');
    }
}