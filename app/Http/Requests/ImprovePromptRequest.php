<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImprovePromptRequest extends FormRequest
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
            'original_prompt' => 'required|string|min:10|max:1000',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'original_prompt.required' => 'Please provide your website idea.',
            'original_prompt.min' => 'Your idea should be at least 10 characters long.',
            'original_prompt.max' => 'Please keep your idea under 1000 characters.',
        ];
    }
}
