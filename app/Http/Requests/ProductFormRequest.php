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
            'title'=>[
                'required',
                'string'
            ],
            'small_description'=>[
                'required',
                'string'
            ],
            'description'=>[
                'required',
                'string'
            ],
            'quantity'=>[
                'required',
                'integer'
            ],
            'status'=>[
               'nullable'
            ],
            'image'=>[
                'nullable',
                // 'image|mimes:jpeg,png,jpg'
            ]



        ];
    }
}