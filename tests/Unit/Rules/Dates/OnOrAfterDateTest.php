<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\OnOrAfterDate;

class OnOrAfterDateTest extends DateRuleTestCase
{
    protected string $ruleClass = OnOrAfterDate::class;

    public function testPassesWhenSameDay(): void
    {
        $this->setRuleData(2, 12, 2022);

        $this->assertRulePasses($this->rule, self::DATE_FIELD, self::VALUE);
    }

    public function testFailsWhenBeforeDay(): void
    {
        $this->setRuleData(1, 12, 2022);

        $this->assertRuleFails($this->rule, self::DATE_FIELD, self::VALUE, ':Attribute must be the same day or after 02/12/2022');
    }

    public function testPassesWhenFutureDay(): void
    {
        $this->setRuleData(3, 12, 2022);

        $this->assertRulePasses($this->rule, self::DATE_FIELD, self::VALUE);
    }

    public function testPassesWhenSameMinute(): void
    {
        $this->setRuleData(2, 12, 2022, '17:05');

        $this->assertRulePasses($this->rule, self::DATE_FIELD, self::VALUE);
    }

    public function testFailsWhenBeforeMinute(): void
    {
        $this->setRuleData(2, 12, 2022, '17:04');

        $this->assertRuleFails($this->rule, self::DATE_FIELD, self::VALUE, ':Attribute must be the same day or after 02/12/2022 17:05');
    }

    public function testPassesWhenFutureMinute(): void
    {
        $this->setRuleData(2, 12, 2022, '17:06');

        $this->assertRulePasses($this->rule, self::DATE_FIELD, self::VALUE);
    }
}
