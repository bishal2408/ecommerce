<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\UploadFileTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class CustomerHomeController extends Controller
{
    use UploadFileTrait;
    use RegistersUsers;
    private $user_photo_path;
    // constructor
    public function __construct()
    {   
        $this->user_photo_path = public_path('upload/user/photo/');
    }

    // user landing page
    public function index()
    {
        return view('welcome');
    }
    // for cutomer registration 
    protected function guard()
    {
        return Auth::guard();
    }
    
    public function customerRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data = $request->all();
        if($request->file('photo')!= null)
        {
            $photoName = $this->uploadFile($request->file('photo'), $this->user_photo_path);
            $data['photo'] = $photoName;
        }
        $data['password'] = Hash::make($request->get('password'));
        $user = User::create($data);
        $this->guard()->login($user);
        return redirect('/checkrole');
    }
}
