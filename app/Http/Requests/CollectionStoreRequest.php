<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollectionStoreRequest extends FormRequest
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
            'collection-name-insert' => 'required',
            'collection-image-insert' => 'required|image|mimes:jpeg,png,jpg,gif'
        ];
    }
    public function messages(){
        return [
          'collection-name-insert.required' => 'Name is required field.',
          'collection-image-insert.required' => 'Image is required field.',
          'collection-image-insert.mimes' => "Image must be jpeg, jpg, png or gif."
        ];
    }
}
