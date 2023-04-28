<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\OnDate;

class OnDateTest extends DateRuleTestCase
{
    protected string $ruleClass = OnDate::class;

    public function testPassesWhenSameDay(): void
    {
        $this->setRuleData(2, 12, 2022);

        $this->assertRulePasses($this->rule, self::DATE_FIELD, self::VALUE);
    }

    public function testFailsWhenNotDay(): void
    {
        $this->setRuleData(1, 12, 2022);

        $this->assertRuleFails($this->rule, self::DATE_FIELD, self::VALUE, ':attribute must be the same day as 02/12/2022');
    }

    public function testPassesWhenSameMinute(): void
    {
        $this->setRuleData(2, 12, 2022, '17:05');

        $this->assertRulePasses($this->rule, self::DATE_FIELD, self::VALUE);
    }

    public function testFailsWhenNotMinute(): void
    {
        $this->setRuleData(1, 12, 2022, '17:06');

        $this->assertRuleFails($this->rule, self::DATE_FIELD, self::VALUE, ':attribute must be the same day as 02/12/2022 17:05');
    }
}
