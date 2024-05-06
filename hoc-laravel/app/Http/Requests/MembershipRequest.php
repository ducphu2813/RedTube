<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MembershipRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'membership_id' => ['required', 'integer'],
            'user_id' => ['required', 'exists:users'],
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'description' => ['nullable'],
            'duration' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
