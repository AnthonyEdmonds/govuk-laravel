<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Times;

use AnthonyEdmonds\GovukLaravel\Rules\Times\AfterTime;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;

class AfterTimeTest extends TestCase
{
    protected Carbon $now;

    protected AfterTime $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->now = Carbon::now();
        Carbon::setTestNow($this->now);

        $this->rule = new AfterTime($this->now);
    }

    public function testFailsWhenSameTime(): void
    {
        $this->assertRuleFails(
            $this->rule,
            'my-time',
            Carbon::now(),
            ":Attribute must be after {$this->now->format('H:i')}",
        );
    }

    public function testFailsWhenBeforeTime(): void
    {
        $this->assertRuleFails(
            $this->rule,
            'my-time',
            Carbon::now()->subMinute(),
            ":Attribute must be after {$this->now->format('H:i')}",
        );
    }

    public function testPassesWhenFutureTime(): void
    {
        $this->assertRulePasses(
            $this->rule,
            'my-time',
            Carbon::now()->addMinute(),
        );
    }
}
