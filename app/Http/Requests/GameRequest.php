<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function messages(): array
    {
        return [
            'score.integer' => 'Score must be an integer.',
            'score.min' => 'Score cannot be less than zero.',
            'score.max' => 'Score cannot be greater than 300',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'score' => 'integer|min:0|max:300',
        ];
    }
}
