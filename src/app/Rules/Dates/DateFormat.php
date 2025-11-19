<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;

class DateFormat extends DateRule
{
    protected function test(?Carbon $enteredDate = null): bool
    {
        return true;
    }
}
