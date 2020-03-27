<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//use Symfony\Component\HttpFoundation\File\Exception\FileException;

class InsertSocksRequest extends FormRequest
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
            "insert-sock-name" => "required",
            "insert-sock-cat" => "required",
            "insert-sock-price" => "required",
            "insert-sock-color" => "required",
            "insert-sock-file" => "required|image|mimes:jpeg,png,jpg,gif"
        ];
    }
    public function messages(){
        return [
            "insert-sock-name.required" => "Name is required field.",
            "insert-sock-cat.required" => "Category is required field.",
            "insert-sock-price.required" => "Price is required field.",
            "insert-sock-color.required" => "Color is required field.",
            "insert-sock-file.required" => "Image is required field.",
            "insert-sock-file.mimes" => "Image must be jpeg, jpg, png or gif."

        ];
    }
}
