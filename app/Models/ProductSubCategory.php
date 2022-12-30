<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id'];

    // define the relationship with the category
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'id');
    }
}
