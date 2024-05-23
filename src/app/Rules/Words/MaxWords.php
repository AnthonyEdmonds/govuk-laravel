<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Words;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxWords implements ValidationRule
{
    public function __construct(protected int $max)
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

        if (substr_count($value, ' ') > $this->max - 1) {
            $fail(":attribute must be {$this->max} words or fewer.");
        }
    }
}
