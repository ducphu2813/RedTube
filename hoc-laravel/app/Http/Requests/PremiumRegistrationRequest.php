<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PremiumRegistrationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'registration_id' => ['required', 'integer'],
            'user_id' => ['required', 'exists:users'],
            'package_id' => ['required', 'exists:premium_package'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
