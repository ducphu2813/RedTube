<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'history_id' => ['required', 'integer'],
            'user_id' => ['required', 'exists:users'],
            'video_id' => ['required', 'exists:video'],
            'created_date' => ['required', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
