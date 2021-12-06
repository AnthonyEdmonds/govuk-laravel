<?php

namespace AnthonyEdmonds\GovukLaravel\Rules;

use Illuminate\Contracts\Validation\Rule;

class Words implements Rule
{
    public function __construct(protected int $words)
    {}

    public function passes($attribute, $value): bool
    {
        return substr_count($value, ' ') <= $this->words - 1;
    }
    
    public function message(): string
    {
        return "The :attribute must be {$this->words} words or fewer";
    }
}
