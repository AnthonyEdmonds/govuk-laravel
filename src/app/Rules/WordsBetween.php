<?php

namespace AnthonyEdmonds\GovukLaravel\Rules;

use Illuminate\Contracts\Validation\Rule;

class WordsBetween implements Rule
{
    public function __construct(protected int $min, protected int $max)
    {
    }

    public function passes($attribute, $value): bool
    {
        $count = substr_count($value, ' ');

        return  $count >= $this->min - 1 && $count <= $this->max -1;
    }

    public function message(): string
    {
        return ":attribute must be between {$this->min} and {$this->max} words.";
    }
}
