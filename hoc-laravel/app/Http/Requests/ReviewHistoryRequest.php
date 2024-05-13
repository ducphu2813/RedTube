<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewHistoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'review_id' => ['required', 'integer'],
            'reviewer_id' => ['required', 'exists:users'],
            'video_id' => ['required', 'exists:video'],
            'note' => ['required'],
            'review_date' => ['required', 'date'],
            'review_status' => ['boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
