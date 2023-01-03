<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable = ['merchant_id', 'name'];
        // define the relationship with the subcategories
    public function subcategories()
    {
        return $this->hasMany(ProductSubCategory::class, 'category_id');
    }

}