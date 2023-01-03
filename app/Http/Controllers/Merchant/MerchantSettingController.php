<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\MerchantSettingRequest;
use App\Models\MerchantSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Traits\UploadFileTrait;

class MerchantSettingController extends Controller
{
    use UploadFileTrait;
    private $merchant_logo_path;
    public function __construct()
    {
        $this->merchant_logo_path = public_path('upload/merchant/logos/');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = MerchantSetting::where('merchant_id', Auth::user()->id)->first();
        if($setting == null){
            $setting = MerchantSetting::create([
                'name'=>'Merchant name',
                'merchant_id' => Auth::user()->id,
            ]);
        }
        // return $setting;
        return view('merchant.setting.index', compact('setting'));
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
    public function store(Request $request)
    {
        //
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
    public function update(MerchantSettingRequest $request, MerchantSetting $setting)
    {
        $request->validated();
        $data = $request->all();

        if ($request->hasFile('logo')) {
            if ($request->get('old_logo') != null) {  
                $this->removePhysicalFile($request->get('old_logo'), $this->merchant_logo_path);
            }
            $logoName = $this->uploadFile($request->file('logo'), $this->merchant_logo_path);
            $data['logo'] = $logoName;
        }
        $setting->update($data);
        return redirect()->route('merchant.setting.index')->with('editMessage', 'Merchant Settings Updated Sucessfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
