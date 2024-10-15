<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = decrypt($this->route('user'));

        return [
            'username' => 'required|string|max:30|unique:users,username,' . $userId,
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $userId,
            'nik' => 'required|string|min:16|unique:users,nik,' . $userId,
            'password' => 'nullable|string|min:6', // Password is optional
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ]));
    }
}
