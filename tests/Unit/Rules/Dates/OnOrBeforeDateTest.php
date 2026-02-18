<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\OnOrBeforeDate;

class OnOrBeforeDateTest extends DateRuleTestCase
{
    protected string $ruleClass = OnOrBeforeDate::class;

    public function testPassesWhenSameDay(): void
    {
        $this->setRuleData(2, 12, 2022);

        $this->assertRulePasses($this->rule, self::DATE_FIELD, self::VALUE);
    }

    public function testPassesWhenBeforeDay(): void
    {
        $this->setRuleData(1, 12, 2022);

        $this->assertRulePasses($this->rule, self::DATE_FIELD, self::VALUE);
    }

    public function testFailsInFutureDay(): void
    {
        $this->setRuleData(3, 12, 2022);

        $this->assertRuleFails($this->rule, self::DATE_FIELD, self::VALUE, ':Attribute must be the same day or before 02/12/2022.');
    }

    public function testPassesWhenSameMinute(): void
    {
        $this->setRuleData(2, 12, 2022, '17:05');

        $this->assertRulePasses($this->rule, self::DATE_FIELD, self::VALUE);
    }

    public function testPassesWhenBeforeMinute(): void
    {
        $this->setRuleData(2, 12, 2022, '17:04');

        $this->assertRulePasses($this->rule, self::DATE_FIELD, self::VALUE);
    }

    public function testFailsInFutureMinute(): void
    {
        $this->setRuleData(2, 12, 2022, '17:06');

        $this->assertRuleFails($this->rule, self::DATE_FIELD, self::VALUE, ':Attribute must be the same day or before 02/12/2022 17:05.');
    }
}
