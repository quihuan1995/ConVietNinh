<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'addrees'=>'required',
            'user_id'=>'required',
            'user_id_b'=>'required',
            'user_id_c'=>'required',
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Ko bỏ trống tên',
            'phone.required'=>'Ko bỏ trống SDT',
            'email.required'=>'Ko bỏ trống Email',
            'addrees.required'=>'Ko bỏ trống Địa Chỉ',
            'user_id.required'=>'Hãy chọn quản lý Order',
            'user_id_b.required'=>'Hãy chọn quản lý Order',
            'user_id_c.required'=>'Hãy chọn quản lý Order',
        ];
    }
}