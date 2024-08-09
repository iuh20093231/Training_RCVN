<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|min:5',
            'email' => 'required|email|unique:mst_users,email',
            'password' => 'required|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'reset_password' => 'required|same:password',
        ];

    }
    public function messages(): array
    {
        return [
            'name.required' => 'Họ tên không được trống',
            'name.min' => 'Tên phải lớn hơn 5 ký tự',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã được đăng ký.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.regex' => 'Mật khẩu không bảo mật. Phải có ít nhất một chữ hoa, một chữ thường và một số.',
            'reset_password.required' => 'Xác nhận mật khẩu không được để trống.',
            'reset_password.same' => 'Mật khẩu và xác nhận mật khẩu không chính xác.',
        ];
    }
}
