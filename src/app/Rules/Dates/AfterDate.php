<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;

class AfterDate extends DateRule
{
    protected function test(Carbon $enteredDate): bool
    {
        if ($enteredDate->isAfter($this->date) === true) {
            return true;
        }

        $this->message = ':attribute must be after '.$this->date->format('d/m/Y');

        return false;
    }
}
