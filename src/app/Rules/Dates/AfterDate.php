<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;

class AfterDate extends DateRule
{
    protected function test(Carbon $enteredDate): bool
    {
        if ($enteredDate->greaterThan($this->date) === true) {
            return true;
        }

        $this->message = ':attribute must be after '.$this->date->format($this->messageFormat);

        return false;
    }
}
