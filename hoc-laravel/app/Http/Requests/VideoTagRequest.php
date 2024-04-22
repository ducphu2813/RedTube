<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoTagRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'video_id' => ['required', 'exists:video'],
            'tag_id' => ['required', 'exists:tag'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
