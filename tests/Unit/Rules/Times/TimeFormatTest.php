<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Times;

use AnthonyEdmonds\GovukLaravel\Rules\Times\TimeFormat;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class TimeFormatTest extends TestCase
{
    protected TimeFormat $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new TimeFormat;
    }

    public function testPassesWhen24HourFormat(): void
    {
        $this->assertRulePasses($this->rule, 'time', '17:35');
    }

    public function testPassesWhen12HourFormatWithLeading(): void
    {
        $this->assertRulePasses($this->rule, 'time', '05:35 pm');
    }

    public function testPassesWhen12HourFormatWithoutLeading(): void
    {
        $this->assertRulePasses($this->rule, 'time', '5:35 pm');
    }

    public function testPassesWhenJustHour(): void
    {
        $this->assertRulePasses($this->rule, 'time', '5 pm');
    }

    public function testPassesWhen12HourFormatWithLeadingNoSpace(): void
    {
        $this->assertRulePasses($this->rule, 'time', '05:35pm');
    }

    public function testPassesWhen12HourFormatWithoutLeadingNoSpace(): void
    {
        $this->assertRulePasses($this->rule, 'time', '5:35pm');
    }

    public function testPassesWhenJustHourNoSpace(): void
    {
        $this->assertRulePasses($this->rule, 'time', '5pm');
    }

    public function testFailsWhenInvalid(): void
    {
        $this->assertRuleFails($this->rule, 'time', '25:61', ':attribute must be in 24 or 12 hour format. When using 12-hour format you must specify "am" or "pm".');
    }
}
