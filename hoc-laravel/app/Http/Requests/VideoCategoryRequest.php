<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'video_id' => ['required', 'exists:video'],
            'category_id' => ['required', 'exists:category'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
