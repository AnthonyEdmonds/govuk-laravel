<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class DateRuleTestCase extends TestCase
{
    const DATE_FIELD = 'my-date';

    const TIME_FIELD = 'my-time';

    const VALUE = 'not-used';

    protected string $ruleClass;

    protected Carbon $now;

    protected ValidationRule|DataAwareRule $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->now = Carbon::create(2022, 12, 2, 17, 5);
        Carbon::setTestNow($this->now);
    }

    protected function setRuleData(
        int $day,
        int $month,
        int $year,
        string|null $time = null,
    ): void {
        $data = [
            'my-date-day' => $day,
            'my-date-month' => $month,
            'my-date-year' => $year,
        ];

        if ($time !== null) {
            $data[self::TIME_FIELD] = $time;
            $this->rule = new $this->ruleClass($this->now, self::TIME_FIELD);
        } else {
            $this->rule = new $this->ruleClass($this->now);
        }

        $this->rule->setData($data);
    }
}
