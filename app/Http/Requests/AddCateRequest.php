<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCateRequest extends FormRequest
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
            'categories'=>'required|unique:categories,categories',
             'images_category'=>'image',
        ];
    }
    public function messages()
    {
        return[
          'categories.required'=>'Ko bỏ trống danh mục',
          'categories.unique'=>'Danh mục đã tồn tại',
          'images_category.image'=>'Ảnh ko đúng định dạng',
        ];
    }
}