<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollectionUpdateRequest extends FormRequest
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
            'collection-name' => 'required',
            'collection-image' => 'image|mimes:jpeg,png,jpg,gif'
        ];
    }
    public function messages(){
        return [
            'collection-name.required' => 'Name is required field.',
            'collection-image.mimes' => "Image must be jpeg, jpg, png or gif."
        ];
    }
}
