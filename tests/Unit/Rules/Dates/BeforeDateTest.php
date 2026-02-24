<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\BeforeDate;

class BeforeDateTest extends DateRuleTestCase
{
    protected string $ruleClass = BeforeDate::class;

    public function testFailsWhenSameDay(): void
    {
        $this->setRuleData(2, 12, 2022);

        $this->assertRuleFails($this->rule, self::DATE_FIELD, self::VALUE, ':Attribute must be before 02/12/2022');
    }

    public function testPassesWhenBeforeDay(): void
    {
        $this->setRuleData(1, 12, 2022);

        $this->assertRulePasses($this->rule, self::DATE_FIELD, self::VALUE);
    }

    public function testFailsWhenFutureDay(): void
    {
        $this->setRuleData(3, 12, 2022);

        $this->assertRuleFails($this->rule, self::DATE_FIELD, self::VALUE, ':Attribute must be before 02/12/2022');
    }

    public function testFailsWhenSameMinute(): void
    {
        $this->setRuleData(2, 12, 2022, '17:05');

        $this->assertRuleFails($this->rule, self::DATE_FIELD, self::VALUE, ':Attribute must be before 02/12/2022 17:05');
    }

    public function testPassesWhenBeforeMinute(): void
    {
        $this->setRuleData(2, 12, 2022, '17:04');

        $this->assertRulePasses($this->rule, self::DATE_FIELD, self::VALUE);
    }

    public function testFailsWhenFutureMinute(): void
    {
        $this->setRuleData(2, 12, 2022, '17:06');

        $this->assertRuleFails($this->rule, self::DATE_FIELD, self::VALUE, ':Attribute must be before 02/12/2022 17:05');
    }
}
