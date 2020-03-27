<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "username_login" => "required|regex:/(?=.*[a-z])(?=.*[0-9])(?=.{8,})/",
            "password_login" => "required|regex:/(?=.*[a-z])(?=.*[0-9])(?=.{8,})/"
        ];
    }
    public function messages(){
        return [
            "username_login.required" => "Username is required field.",
            "password_login.required" => "Password is required field."
        ];
    }
}
