<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer'],
            'user_name' => ['required'],
            'channel_name' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required'],
            'description' => ['nullable'],
            'created_date' => ['nullable', 'date'],
            'active' => ['boolean'],
            'picture_url' => ['nullable'],
            'role' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
