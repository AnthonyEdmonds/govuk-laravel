<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;

class OnOrAfterDate extends DateRule
{
    protected function test(?Carbon $enteredDate = null): bool
    {
        if ($enteredDate->greaterThanOrEqualTo($this->date) === true) {
            return true;
        }

        $this->message = ':attribute must be the same day or after ' . $this->date->format($this->messageFormat);

        return false;
    }
}
