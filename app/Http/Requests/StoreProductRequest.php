<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'category_id' => "required|integer",
            'name' => 'required|string',
            'sale_num' => 'required|integer',
            'product_content' => 'required',
            'sort' => 'required|integer',
            'status' => [
                'required',
                Rule::in(['1', '2', '3']),
            ],
        ];
    }
}
