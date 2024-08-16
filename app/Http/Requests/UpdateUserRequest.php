<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $id = $this->route('id');
        $rules = [
            'name' => 'required|string|min:5',
            'email' => 'required|string|email|max:255|unique:mst_users,email,' . $id,
        ];
        if ($this->filled('password')) {
            $rules['password'] = 'min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/';
            $rules['reset_password'] = 'required|same:password';
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống.',
            'name.string' => 'Tên phải là chuỗi.',
            'name.min' => 'Tên phải có ít nhất 5 ký tự.',
            'email.required' => 'Email không được để trống.',
            'email.string' => 'Email phải là chuỗi.',
            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.regex' => 'Mật khẩu không bảo mật. Phải có ít nhất một chữ hoa, một chữ thường và một số.',
            'reset_password.required' => 'Xác nhận mật khẩu không được trống',
            'reset_password.same' => 'Mật khẩu và xác nhận mật khẩu không chính xác.'
        ];
    }
}
