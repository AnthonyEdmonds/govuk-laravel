<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\DateFormat;

class DateFormatTest extends DateRuleTestCase
{
    protected string $ruleClass = DateFormat::class;

    public function testFailsWhenMissingDay(): void
    {
        $this->setRuleData('', 12, 2022);

        $this->assertRuleFails($this->rule, self::DATE_FIELD, self::VALUE, ':attribute day must be a number');
    }

    public function testFailsWhenMissingMonth(): void
    {
        $this->setRuleData(2, '', 2022);

        $this->assertRuleFails($this->rule, self::DATE_FIELD, self::VALUE, ':attribute month must be a number');
    }

    public function testFailsWhenMissingYear(): void
    {
        $this->setRuleData(2, 12, '');

        $this->assertRuleFails($this->rule, self::DATE_FIELD, self::VALUE, ':attribute year must be either two or four digits long');
    }

    public function testPassesWhenBeforeDay(): void
    {
        $this->setRuleData(1, 12, 2022);

        $this->assertRulePasses($this->rule, self::DATE_FIELD, self::VALUE);
    }
}
