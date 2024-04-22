<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SharePremiumRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'share_id' => ['required', 'integer'],
            'user_id' => ['required', 'exists:users'],
            'premium_registration_id' => ['required', 'exists:premium_registration'],
            'created_date' => ['required', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
