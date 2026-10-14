<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'email'      => 'required|email|unique:users,email',
            'phone'      => 'required|string|max:20',
            'address'    => 'required|string|max:255',
            'state'      => 'required|string|max:100',
            'country'    => 'required|string|max:100',
            'zip_code'   => 'required|string|max:20',
            'password'   => 'required|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ];
    }

}
