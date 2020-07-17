<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserDRequest extends FormRequest
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
            'password'=>'required',
            'address'=>'required',
            'user_id_d'=>'required|unique:users_d,user_id_d'

        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Ko bỏ trống tên',
            'phone.required'=>'Ko bỏ trống SDT',
            'password.required'=>'Ko bỏ trống Mật Khẩu',
            'address.required'=>'Ko bỏ trống Địa Chỉ',
            'user_id_d.required'=>'Ko bỏ trống Mã Nhân VIên',
            'user_id_d.unique'=>'Mã đã tồn tại'

        ];
    }
}