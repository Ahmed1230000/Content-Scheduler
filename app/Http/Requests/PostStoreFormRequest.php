<?php

namespace App\Http\Requests;

use App\Enums\PostStatus;
use App\Rules\MaxScheduledPostsPerDay;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostStoreFormRequest extends FormRequest
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
            'title'          => ['required', 'string', 'max:255'],
            'content'        => ['required', 'string'],
            'image_url'      => ['nullable', 'url', 'max:2048'],
            'scheduled_time' => ['nullable', 'date', new MaxScheduledPostsPerDay()],
            'status'         => ['required', Rule::enum(PostStatus::class)],
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
            'title.required' => 'The title is required.',
            'content.required' => 'The content is required.',
            'image_url.url' => 'The image URL must be a valid URL.',
            'scheduled_time.date' => 'The scheduled time must be a valid date.',
            'status.required' => 'The status is required.',
            'platforms.required' => 'At least one platform must be selected.',
            'platforms.*.exists' => 'The selected platform does not exist.',
        ];
    }
}
