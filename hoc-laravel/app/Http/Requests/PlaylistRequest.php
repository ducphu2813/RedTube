<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaylistRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'playlist_id' => ['required', 'integer'],
            'user_id' => ['required', 'exists:users'],
            'name' => ['required'],
            'created_date' => ['required', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
