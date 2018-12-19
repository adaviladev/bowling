<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RollRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    public function messages()
    {
        return [
            'rolls.required' => 'Variable $rolls is required.',
            'rolls.array' => 'Variable $rolls must be an array.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rolls' => 'required|array',
            'rolls.*' => 'required|integer|min:0|max:10',
        ];
    }
}
