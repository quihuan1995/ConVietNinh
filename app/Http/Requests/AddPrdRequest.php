<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPrdRequest extends FormRequest
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
            'menu_id'=>'required|unique:products,menu_id',
            'name_product'=>'required',
            'quantity'=>'required',
            'content'=>'required',
            'price_product'=>'required|numeric',
            'start_discount'=>'required',
            'stop_discount'=>'required',
            'images_product'=>'image', // file phải là định dạng ảnh
        ];
    }
  public function messages()
    {
        return [
            'menu_id.required'=>'Ko bỏ trống mã Product',
			'menu_id.unique'=>'Mã đã tồn tại',
            'name_product.required'=>'ko bỏ trống tên Product',
            'quantity.required'=>'Ko bỏ trống số lượng',
            'content.required'=>'Ko bỏ trống Chi tiết',
            'price_product.required'=>'Ko bỏ trống giá',
            'price_product.numeric'=>'Giá product ko đúng định dạng',
            'images_product'=>'Ảnh ko đúng định dạng',
            'start_discount.required'=>'Ko bỏ trống ngày khuyến mãi',
            'stop_discount.required'=>'Ko bỏ trống ngày khuyến mãi'
        ];
    }
}