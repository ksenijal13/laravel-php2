<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "first_name" => ["required", "regex:/^[A-ZŠĐŽČĆ][a-zšđžčć]{2,13}(\s[A-ZŠĐŽČĆ][a-zšđžčć]{2,13})*$/"],
            "last_name" => ["required", "regex:/^[A-ZŠĐŽČĆ][a-žćčžš]{2,13}(\s[A-ZŠĐŽČĆ][a-žćčžš]{2,13})*$/"],
            "username_signup" => ["required", "regex:/(?=.*[a-z])(?=.*[0-9])(?=.{8,})/"],
            "password_signup" => ["required", "regex:/(?=.*[a-z])(?=.*[0-9])(?=.{8,})/"],
            "repeat_password" => "required|same:password_signup",
            "user_email" => "required|email"
        ];
    }
    public function messages(){
        return [
            "first_name.required" => "First name is required field.",
            "last_name.required" => "Last name is required field.",
            "username_signup.required" => "Username is required field.",
            "password_signup.required" => "Password is required field.",
            "repeat_password.same" => "Invalid repeated password.",
            "user_email.required" => "Email is required field.",
            "user_email.email" => "Email is not in valid format."
        ];
    }
}
