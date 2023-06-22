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
        return false;
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
            'image'=>[
                'nullable'

            ],
            'title'=>[
                'required',
                'integer'
            ],
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
                ''

            ],
            'title'=>[
                'required',
                'integer'
            ],
            'brand'=>[
                'required',
                'string',
                'max:255'
            ]

        ];
    }
}