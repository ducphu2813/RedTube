<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserMembershipRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'subscription_id' => ['required', 'integer'],
            'user_id' => ['required', 'exists:users'],
            'membership_id' => ['required', 'exists:membership'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
