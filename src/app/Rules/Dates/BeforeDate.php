<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;

class BeforeDate extends DateRule
{
    protected function test(Carbon $enteredDate): bool
    {
        if ($enteredDate->lessThan($this->comparedTo) === true) {
            return true;
        }

        $this->message = ':Attribute must be before ' . $this->comparedTo->format($this->messageFormat);

        return false;
    }
}
