<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;

class OnDate extends DateRule
{
    protected function test(Carbon $enteredDate): bool
    {
        if ($enteredDate->equalTo($this->date) === true) {
            return true;
        }

        $this->message = ":Attribute must be the same day as {$this->date->format($this->messageFormat)}.";

        return false;
    }
}
