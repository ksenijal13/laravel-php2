<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSocksRequest extends FormRequest
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
            "file" => "image|mimes:jpeg,png,jpg,gif"
        ];
    }
    public function messages(){
        return [
            "file.mimes" => "Image must be jpeg, jpg, png or gif."
        ];
    }
}
