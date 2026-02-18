<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Times;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BeforeTime implements ValidationRule
{
    public function __construct(
        protected Carbon $date,
    ) {
        $this->date->setDate(2000, 1, 1);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Carbon::parse($value)->setDate(2000, 1, 1)->isBefore($this->date) === false) {
            $fail(":Attribute must be before {$this->date->format('H:i')}.");
        }
    }
}
