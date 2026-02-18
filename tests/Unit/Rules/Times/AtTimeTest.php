<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Times;

use AnthonyEdmonds\GovukLaravel\Rules\Times\AtTime;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;

class AtTimeTest extends TestCase
{
    protected Carbon $now;

    protected AtTime $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->now = Carbon::now();
        Carbon::setTestNow($this->now);

        $this->rule = new AtTime($this->now);
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
            ":Attribute must be the same time as {$this->now->format('H:i')}.",
        );
    }

    public function testFailsWhenFutureTime(): void
    {
        $this->assertRuleFails(
            $this->rule,
            'my-time',
            Carbon::now()->addMinute(),
            ":Attribute must be the same time as {$this->now->format('H:i')}.",
        );
    }
}
