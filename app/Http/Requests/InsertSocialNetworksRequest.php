<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertSocialNetworksRequest extends FormRequest
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
            "soc-network-name-insert" => "required",
            "soc-network-icon-insert" => "required",
            "soc-network-url-insert" => "required|url"
        ];
    }
    public function messages(){
        return [
            "soc-network-name-insert.required" => "Name is required field.",
            "soc-network-icon-insert.required" => "Icon is required field.",
            "soc-network-url-insert.required" => "Url is required field.",
            "soc-network-url-insert.url" => "Url is not in valid form."


        ];
    }
}
