<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $checkNullableOrRequired = isset($this->product) ? 'nullable' : 'required|file|mimes:jpeg,png,gif,jpg|max:2048';
        return [
            'name'=>'required',
            'description'=>'required',
            'category'=>'required',
            'photo'=> $checkNullableOrRequired,
            'price'=>'required',
            'stock_quantity'=>'required',
        ];
    }
}
