<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PremiumPackageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'package_id' => ['required', 'integer'],
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'duration' => ['required', 'integer'],
            'description' => ['nullable'],
            'share_limit' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
