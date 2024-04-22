<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'video_id' => ['required', 'integer'],
            'title' => ['required'],
            'users_id' => ['required', 'exists:users'],
            'created_date' => ['required', 'date'],
            'view' => ['required', 'integer'],
            'description' => ['nullable'],
            'display_mode' => ['boolean'],
            'membership' => ['boolean'],
            'active' => ['boolean'],
            'video_path' => ['required'],
            'thumbnail_path' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
