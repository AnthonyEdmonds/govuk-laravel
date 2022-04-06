<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Words;

use Illuminate\Contracts\Validation\Rule;

class MinWords implements Rule
{
    public function __construct(protected int $min)
    {
    }

    public function passes($attribute, $value): bool
    {
        while (str_contains($value, '  ') === true) {
            $value = trim($value);
            $value = str_replace('  ', ' ', $value);
        }

        return substr_count($value, ' ') >= $this->min - 1;
    }

    public function message(): string
    {
        return ":attribute must be {$this->min} words or more.";
    }
}
