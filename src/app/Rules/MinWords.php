<?php

namespace AnthonyEdmonds\GovukLaravel\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinWords implements Rule
{
    public function __construct(protected int $min)
    {
    }

    public function passes($attribute, $value): bool
    {
        return substr_count($value, ' ') >= $this->min - 1;
    }

    public function message(): string
    {
        return ":attribute must be {$this->min} words or more.";
    }
}
