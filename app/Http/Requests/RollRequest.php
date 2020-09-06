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
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'rolls' => 'required|array|min:12|max:20',
            'rolls.*' => 'required|integer|min:0|max:10',
        ];
    }
}
