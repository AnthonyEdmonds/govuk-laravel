<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Times;

use AnthonyEdmonds\GovukLaravel\Rules\Times\AtOrAfterTime;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;

class AtOrAfterTimeTest extends TestCase
{
    protected Carbon $now;

    protected AtOrAfterTime $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->now = Carbon::now();
        Carbon::setTestNow($this->now);

        $this->rule = new AtOrAfterTime($this->now);
    }

    public function testPassesWhenSameTime(): void
    {
        $this->assertRulePasses(
            $this->rule,
            'my-time',
            Carbon::now(),
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
