<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id'=>[
                'required',
                'integer'
            ],
            'images'=>[
                'nullable'

            ],
            'title'=>[
                'required',
                'string'
            ],
            // 'image'=>[
            //     'nullable'
            // ],
            'brand'=>[
                'required',
                'string',
                'max:255'
            ],
            'small_description'=>[
                'required',
                'string'
            ],
            'description'=>[
                'required',
                'string'

            ],
            'orignal_price'=>[
                'required',
                'integer'
            ],
            'selling_price'=>[
                'required',
                'integer'
            ],
            'quantity'=>[
                'required',
                'integer'
            ],
            'product_code'=>[
                'required',
                'string'
            ],
            'status'=>[
               'nullable'
            ],


        ];
    }
}