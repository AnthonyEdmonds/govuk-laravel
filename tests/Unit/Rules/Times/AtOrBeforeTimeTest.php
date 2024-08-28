<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Times;

use AnthonyEdmonds\GovukLaravel\Rules\Times\AtOrBeforeTime;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;

class AtOrBeforeTimeTest extends TestCase
{
    protected Carbon $now;

    protected AtOrBeforeTime $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->now = Carbon::now();
        Carbon::setTestNow($this->now);

        $this->rule = new AtOrBeforeTime($this->now);
    }

    public function testPassesWhenSameTime(): void
    {
        $this->assertRulePasses(
            $this->rule,
            'my-time',
            Carbon::now(),
        );
    }

    public function testFailsWhenAfterTime(): void
    {
        $this->assertRuleFails(
            $this->rule,
            'my-time',
            Carbon::now()->addMinute(),
            ':attribute must be before ' . $this->now->format('H:i'),
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
