<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscribeToPlatformFormRequest extends FormRequest
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
            'platforms'      => ['required', 'array'],
            'platforms.*'    => ['required', 'integer', Rule::exists('platforms', 'id')],

        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */

    public function messages(): array
    {
        return [
            'platforms.required' => 'At least one platform must be selected.',
            'platforms.*.exists' => 'The selected platform does not exist.',
        ];
    }
}
