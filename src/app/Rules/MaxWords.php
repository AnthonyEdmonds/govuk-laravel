<?php

namespace AnthonyEdmonds\GovukLaravel\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxWords implements Rule
{
    public function __construct(protected int $max)
    {
    }

    public function passes($attribute, $value): bool
    {
        return substr_count($value, ' ') <= $this->max - 1;
    }

    public function message(): string
    {
        return ":attribute must be {$this->max} words or fewer.";
    }
}
