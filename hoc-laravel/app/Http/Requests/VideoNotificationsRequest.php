<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoNotificationsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'notification_id' => ['required', 'integer'],
            'user_id' => ['required', 'exists:users'],
            'video_id' => ['required', 'exists:video'],
            'message' => ['required'],
            'created_date' => ['required', 'date'],
            'is_read' => ['boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
