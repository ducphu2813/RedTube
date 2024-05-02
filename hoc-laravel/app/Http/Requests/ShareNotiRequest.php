<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShareNotiRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'noti_id' => ['required', 'integer'],
            'sender_id' => ['required', 'exists:users'],
            'receiver_id' => ['required', 'exists:users'],
            'registration_id' => ['required', 'exists:premium_registration'],
            'status' => ['boolean'],
            'created_date' => ['required', 'date'],
            'expiry_date' => ['required', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
