<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Times;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;
use Illuminate\Validation\Concerns\ValidatesAttributes;

class TimeFormat implements ValidationRule
{
    use ValidatesAttributes;

    public const array TIME_FORMATS = [
        'H:i',   // 17:03
        'h:ia',  // 05:03pm
        'g:ia',  //  5:03pm
        'ga',    //     5pm
    ];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $time = Str::of($value)
            ->replace(' ', '')
            ->replace('.', ':')
            ->lower()
            ->toString();

        if ($this->validateDateFormat($attribute, $time, self::TIME_FORMATS) === false) {
            $fail(':Attribute must be in 24 or 12 hour format. When using 12-hour format you must specify "am" or "pm"');
        }
    }
}
