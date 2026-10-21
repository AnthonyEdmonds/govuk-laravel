<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;

class AfterDate extends DateRule
{
    protected function test(Carbon $enteredDate, Carbon $comparisonDate): ?string
    {
        if ($enteredDate->greaterThan($comparisonDate) === false) {
            return ':Attribute must be after ' . $comparisonDate->format($this->messageFormat);
        }

        return null;
    }
}
