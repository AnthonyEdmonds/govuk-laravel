<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;

class OnDate extends DateRule
{
    protected function test(Carbon $enteredDate): bool
    {
        if ($enteredDate->isSameDay($this->date) === true) {
            return true;
        }

        $this->message = ':attribute must be the same day as ' . $this->date->format('d/m/Y');
        return false;
    }
}
