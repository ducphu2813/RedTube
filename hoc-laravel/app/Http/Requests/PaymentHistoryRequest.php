<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentHistoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payment_id' => ['required', 'integer'],
            'user_id' => ['required', 'exists:users'],
            'payment_date' => ['required', 'date'],
            'amount' => ['required', 'numeric'],
            'full_name' => ['required'],
            'address' => ['required'],
            'phone' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
