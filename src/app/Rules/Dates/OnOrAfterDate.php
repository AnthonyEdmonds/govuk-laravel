<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;

class OnOrAfterDate extends DateRule
{
    protected function test(Carbon $enteredDate): bool
    {
        if ($enteredDate->isSameDay($this->date) === true) {
            return true;
        }

        if ($enteredDate->isAfter($this->date) === true) {
            return true;
        }

        $this->message = ':attribute must be the same day or after '.$this->date->format('d/m/Y');

        return false;
    }
}
