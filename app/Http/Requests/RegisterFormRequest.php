<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterFormRequest extends FormRequest
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
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', Rule::unique('users')],
            'password'              => ['required', 'string', 'min:4', 'max:9', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'platforms'      => ['required', 'array'],
            'platforms.*'    => ['required', 'integer', Rule::exists('platforms', 'id')],

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
            'name.required'      => 'Name is required.',
            'email.required'     => 'Email is required.',
            'email.unique'       => 'Email already exists.',
            'password.required'  => 'Password is required.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
