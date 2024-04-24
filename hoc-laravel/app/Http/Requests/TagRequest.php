<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'tag_id' => ['required', 'integer'],
            'name' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
