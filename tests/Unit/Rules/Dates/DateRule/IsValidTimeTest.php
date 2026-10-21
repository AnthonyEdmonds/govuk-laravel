<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates\DateRule;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\AfterDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\DateRule;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\DataProvider;

class IsValidTimeTest extends TestCase
{
    protected DateRule $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new AfterDate(Carbon::today());
    }

    #[DataProvider('expectations')]
    public function test(
        ?string $time,
        ?string $expected,
    ): void {
        $this->assertEquals(
            $expected,
            $this->rule->isValidTime($time),
        );
    }

    public static function expectations(): array
    {
        return [
            [
                'time' => null,
                'expected' => null,
            ],
            [
                'time' => '12:59',
                'expected' => null,
            ],
            [
                'time' => '25:60',
                'expected' => ':Attribute is not a valid time',
            ],
            [
                'time' => '',
                'expected' => ':Attribute is not a valid time',
            ],
        ];
    }
}
