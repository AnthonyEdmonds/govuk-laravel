<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;

class OnOrBeforeDate extends DateRule
{
    protected function test(Carbon $enteredDate): bool
    {
        if ($enteredDate->isSameDay($this->date) === true) {
            return true;
        }

        if ($enteredDate->isBefore($this->date) === true) {
            return true;
        }

        $this->message = ':attribute must be the same day or before ' . $this->date->format('d/m/Y');
        return false;
    }
}
