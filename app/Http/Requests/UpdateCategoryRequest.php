<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'attr1' => 'string|max:10|nullable',
            'attr2' => 'string|max:10|nullable',
            'attr3' => 'string|max:10|nullable',
            'sort' => 'required|integer',
            'status' => [
                'required',
                Rule::in(['1', '2', '3']),
            ],
        ];
    }
}
