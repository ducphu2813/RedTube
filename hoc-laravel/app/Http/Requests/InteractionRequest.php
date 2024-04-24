<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InteractionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users'],
            'video_id' => ['required', 'exists:video'],
            'reaction' => ['boolean'],
            'created_date' => ['required', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
