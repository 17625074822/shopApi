<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNavRequest extends FormRequest
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
            'position_id' => "required",
            'title' => "required|min:1|max:50",
            'picture' => "required|min:1|max:255",
            'link_type' => "required|min:1",
            'link_target' => "required|min:1",
            'link_type' => "required|min:1"
        ];
    }
}
