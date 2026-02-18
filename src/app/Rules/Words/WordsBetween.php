<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Words;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class WordsBetween implements ValidationRule
{
    public function __construct(protected int $min, protected int $max)
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

        $count = substr_count($value, ' ');

        if (
            $count < $this->min - 1
            || $count > $this->max - 1
        ) {
            $fail(":Attribute must be between {$this->min} and {$this->max} words.");
        }
    }
}
