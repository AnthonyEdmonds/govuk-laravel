<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

abstract class DateRuleTestCase extends TestCase
{
    public const string DATE_FIELD = 'my-date';

    public const string TIME_FIELD = 'my-time';

    public const string VALUE = 'not-used';

    protected string $ruleClass;

    protected Carbon $now;

    protected ValidationRule|DataAwareRule $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->now = Carbon::create(2022, 12, 2, 17, 5);
        Carbon::setTestNow($this->now);
    }

    public function testFailsWhenInvalidDay(): void
    {
        $this->setRuleData('/', 12, 2022);

        $this->assertRuleFails($this->rule, self::DATE_FIELD, self::VALUE, ':attribute day must be a number');
    }

    public function testFailsWhenInvalidMonth(): void
    {
        $this->setRuleData(1, '/', 2022);

        $this->assertRuleFails($this->rule, self::DATE_FIELD, self::VALUE, ':attribute month must be a number');
    }

    public function testFailsWhenInvalidYear(): void
    {
        $this->setRuleData(1, 12, '/');

        $this->assertRuleFails($this->rule, self::DATE_FIELD, self::VALUE, ':attribute year must be a number');
    }

    protected function setRuleData(
        int|string $day,
        int|string $month,
        int|string $year,
        ?string $time = null,
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
