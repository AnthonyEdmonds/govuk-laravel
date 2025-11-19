<?php

namespace AnthonyEdmonds\GovukLaravel\Rules\Dates;

use Carbon\Carbon;

class DateFormat extends DateRule
{
    public function __construct(?string $timeField = null)
    {
        parent::__construct(Carbon::now(), $timeField);
    }

    protected function test(Carbon $enteredDate): bool
    {
        return true;
    }
}
