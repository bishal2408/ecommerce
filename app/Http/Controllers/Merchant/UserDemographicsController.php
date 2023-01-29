<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDemographicsController extends Controller
{
    public function index()
    {
        return view('merchant.demographics.index');
    }
}
