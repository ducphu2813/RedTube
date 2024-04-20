<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'comment_id' => ['required', 'integer'],
            'user_id' => ['required', 'exists:users'],
            'video_id' => ['required', 'exists:video'],
            'reply_id' => ['nullable', 'exists:comment'],
            'content' => ['required'],
            'created_date' => ['required', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
