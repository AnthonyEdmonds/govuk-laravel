<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;

class OnOrAfterDate extends DateRule
{
    protected function test(Carbon $enteredDate): bool
    {
        if ($enteredDate->greaterThanOrEqualTo($this->comparedTo) === true) {
            return true;
        }

        $this->message = ':Attribute must be the same day or after ' . $this->comparedTo->format($this->messageFormat);

        return false;
    }
}
