<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;

class OnOrBeforeDate extends DateRule
{
    protected function test(Carbon $enteredDate): bool
    {
        if ($enteredDate->lessThanOrEqualTo($this->comparedTo) === true) {
            return true;
        }

        $this->message = ':Attribute must be the same day or before ' . $this->comparedTo->format($this->messageFormat);

        return false;
    }
}
