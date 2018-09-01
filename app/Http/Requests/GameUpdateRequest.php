<?php

namespace App\Http\Requests;

use App\Game;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class GameUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $game = $this->route('game');

        return $game->user_id === auth()->id();
    }

    public function messages()
    {
        return [
            'rolls.array' => 'Rolls must be an array.',
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
            'rolls' => 'required|array'
        ];
    }
}
