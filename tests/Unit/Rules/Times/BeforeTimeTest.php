<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Times;

use AnthonyEdmonds\GovukLaravel\Rules\Times\BeforeTime;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;

class BeforeTimeTest extends TestCase
{
    protected Carbon $now;

    protected BeforeTime $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->now = Carbon::now();
        Carbon::setTestNow($this->now);

        $this->rule = new BeforeTime($this->now);
    }

    public function testFailsWhenSameTime(): void
    {
        $this->assertRuleFails(
            $this->rule,
            'my-time',
            Carbon::now(),
            ':Attribute must be before ' . $this->now->format('H:i'),
        );
    }

    public function testFailsWhenAfterTime(): void
    {
        $this->assertRuleFails(
            $this->rule,
            'my-time',
            Carbon::now()->addMinute(),
            ':Attribute must be before ' . $this->now->format('H:i'),
        );
    }

    public function testPassesWhenPastTime(): void
    {
        $this->assertRulePasses(
            $this->rule,
            'my-time',
            Carbon::now()->subMinute(),
        );
    }
}
