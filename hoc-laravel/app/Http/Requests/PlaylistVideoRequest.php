<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaylistVideoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'playlist_id' => ['required', 'exists:playlist'],
            'video_id' => ['required', 'exists:video'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
