<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Forms\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

class NameFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
        ];
    }
}
