<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;

class BeforeDate extends DateRule
{
    protected function test(Carbon $enteredDate): bool
    {
        if ($enteredDate->lessThan($this->date) === true) {
            return true;
        }

        $this->message = ':attribute must be before '.$this->date->format($this->messageFormat);

        return false;
    }
}
