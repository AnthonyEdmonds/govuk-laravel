<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\BeforeDate;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;

class BeforeDateTest extends TestCase
{
    const ATTRIBUTE = 'my-date';

    const VALUE = 'not-used';

    protected Carbon $now;

    protected BeforeDate $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->now = Carbon::create(2022, 12, 2);
        Carbon::setTestNow($this->now);

        $this->rule = new BeforeDate($this->now);
    }

    public function testFailsWhenSameDay(): void
    {
        $this->setRuleData(2, 12, 2022);

        $this->assertFalse(
            $this->rule->passes(self::ATTRIBUTE, self::VALUE)
        );

        $this->assertEquals(
            ':attribute must be before 02/12/2022',
            $this->rule->message()
        );
    }

    public function testPassesWhenBeforeDay(): void
    {
        $this->setRuleData(1, 12, 2022);

        $this->assertTrue(
            $this->rule->passes(self::ATTRIBUTE, self::VALUE)
        );
    }

    public function testFailsWhenFutureDay(): void
    {
        $this->setRuleData(3, 12, 2022);

        $this->assertFalse(
            $this->rule->passes(self::ATTRIBUTE, self::VALUE)
        );

        $this->assertEquals(
            ':attribute must be before 02/12/2022',
            $this->rule->message()
        );
    }

    protected function setRuleData(int $day, int $month, int $year): void
    {
        $this->rule->setData([
            'my-date-day' => $day,
            'my-date-month' => $month,
            'my-date-year' => $year,
        ]);
    }
}
