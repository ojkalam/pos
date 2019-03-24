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
    public function authorize()
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
        return [
            'p_name'                  => 'required',
            'category_id'             => 'required|integer',
            'sku'                     => 'required',
            'stock_quantity'          => 'required|integer',
            'default_purchase_price'  => 'required|integer',
            'sell_price_inc_tax'      => 'required',
            'p_image'                 => 'mimes:jpeg,jpg,png'
        ];
    }

    //customizing the error message
    public function messages()
    {
        return [
            // 'p_name.required' => 'A title is required',
            // 'p_image.mimes'  => 'only jpeg, jpg, png',
        ];
    }

    //customizing attribute of field
    public function attributes()
    {
        return [
            'p_name' => 'Product Name',
            'category_id' => 'Product Category',
            'sell_price_inc_tax' => 'Sell price including tax',
        ];
    }


}
