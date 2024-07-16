<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => 'required|min:6',
            'product_price' => 'required|numeric|min:0',
            'description' => 'nullable',
            'is_sales' => 'required',
            'product_image' => 'max:2048',
            // mimes:png,jpg,jpeg required|
        ];
    }
    public function messages(): array
    {
        return [
            'product_name.required' => 'Vui lòng nhập tên sản phẩm',
            'product_name.min' => 'Tên phải lớn hơn 5 ký tự',
            'product_price.required' => 'Giá bán không được để trống.',
            'product_price.numeric' => 'Giá bán chỉ được nhập số.',
            'product_price.min' => 'Giá bán không được nhỏ hơn 0.',
            'is_sales.required' => 'Trạng thái không được để trống.',
           // 'product_image.required' => 'Vui lòng upload hình sản phẩm.',
           // 'product_image.mimes' => 'Chỉ cho upload các file hình png, jpg, jpeg.',
            'product_image.max' => 'Dung lượng hình không quá 2Mb.',
        ];
    }
}
