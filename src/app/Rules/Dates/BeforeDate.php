<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;

class BeforeDate extends DateRule
{
    protected function test(Carbon $enteredDate): bool
    {
        if ($enteredDate->isBefore($this->date) === true) {
            return true;
        }

        $this->message = ':attribute must be before ' . $this->date->format('d/m/Y');
        return false;
    }
}
