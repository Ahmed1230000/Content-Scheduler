<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginFormRequest extends FormRequest
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
            'email'    => ['required', 'string', 'email', Rule::exists('users', 'email')],
            'password' => ['required', 'string', 'min:4', 'max:9'],
        ];
    }

    /**
     * Get custom error messages for the defined validation rules.
     *
     * @return array<string, string>
     */

    public function messages(): array
    {
        return [
            'email.required'    => 'Email is required.',
            'email.email'       => 'Email must be a valid email address.',
            'password.required' => 'Password is required.',
            'password.min'      => 'Password must be at least 4 characters.',
            'password.max'      => 'Password may not be greater than 9 characters.',
            'email.exists'      => 'The provided credentials do not match our records.',
            'email.string'      => 'Email must be a string.',
            'password.string'   => 'Password must be a string.',
        ];
    }
}
