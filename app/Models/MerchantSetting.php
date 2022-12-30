<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'phone', 'phone_no_2', 'merchant_id',
        'logo', 'location', 'fb_link', 'insta_link', 'youtube_link',
    ];
    protected $appends = ['merchant_logo'];
    public function getMerchantLogoAttribute(){
        return asset('upload/merchant/logos/')."/".$this->logo;
    }
}
