<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'contact-phone' => 'required|numeric',
            'contact-address' => 'required',
            'contact-email' => 'required|email'
        ];
    }
    public function messages(){
        return [
            'contact-phone.required' => 'Phone is required field.',
            'contact-address.required' => 'Address is required field.',
            'contact-email.required' => 'Email is required field.',
            'contact-phone.numeric' => 'Phone must be number. No letters allowed.',
            'contact-email.email' => 'Email is not in valid form.'
        ];
    }
}
