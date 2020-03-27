<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
            'about-biography' => 'required',
            'about-image' => 'image|mimes:jpeg,png,jpg,gif'
        ];
    }
    public function messages(){
        return [
            "about-image.mimes" => "Image must be jpeg, jpg, png or gif."
        ];
    }
}
