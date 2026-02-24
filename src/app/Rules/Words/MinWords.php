<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Words;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MinWords implements ValidationRule
{
    public function __construct(protected int $min)
    {
        //
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (str_contains($value, "\n") === true) {
            $value = str_replace("\n", ' ', $value);
        }

        while (str_contains($value, '  ') === true) {
            $value = trim($value);
            $value = str_replace('  ', ' ', $value);
        }

        if (substr_count($value, ' ') < $this->min - 1) {
            $fail(":Attribute must be $this->min words or more");
        }
    }
}
