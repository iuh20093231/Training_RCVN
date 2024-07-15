<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'customer_name' => 'required|min:5',
            'email' => 'required|email|unique:custormers,email',
            'tel_num' => 'required|string|regex:/^[0-9]{10,15}$/',
            'address' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'customer_name.required' => 'Họ tên không được trống',
            'customer_name.min' => 'Tên phải lớn hơn 5 ký tự',
            'email.required' => 'Email không được để trống.',
            'email.unique' => 'Email không được trùng.',
            'email.email' => 'Email không đúng định dạng.',
            'tel_num.required' => 'Số điện thoại không được để trống',
            'tel_num.regex' => 'Số điện thoại không đúng định dạng',
            'address.required' => 'Địa chỉ không được trống',
        ];
    }
}
