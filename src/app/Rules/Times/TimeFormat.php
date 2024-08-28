<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Times;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Concerns\ValidatesAttributes;

class TimeFormat implements ValidationRule
{
    use ValidatesAttributes;

    public const TIME_FORMATS = [
        'H:i',   // 17:03
        'h:i a', // 05:03 pm
        'h:ia',  // 05:03pm
        'g:i a', //  5:03 pm
        'g:ia',  //  5:03pm
        'g a',   //     5 pm
        'ga',    //     5pm
    ];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->validateDateFormat($attribute, $value, self::TIME_FORMATS) === false) {
            $fail(':attribute must be in 24 or 12 hour format. When using 12-hour format you must specify "am" or "pm".');
        }
    }
}
