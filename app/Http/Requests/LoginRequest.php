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
            'phone'=>'required|phone|min:5',
            'password'=>'required|min:5'
        ];
    }
    public function messages()
    {
        return[
            'phone.required'=>'Do not be empty phone',
            'phone.phone'=>'phone is not be malformed',
            'phone.min'=>'phone  are not be smaller than 5 characters',
            'password.required'=>'Do not be empty Password',
            'password.min'=>'Password are not be smaller than 5 characters',
        ];
    }
}
