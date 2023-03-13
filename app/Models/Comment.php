<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id', 'comments'];

    public function commentUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
