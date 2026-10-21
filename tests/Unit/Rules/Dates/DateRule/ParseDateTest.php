<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates\DateRule;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\AfterDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\DateRule;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\DataProvider;

class ParseDateTest extends TestCase
{
    protected DateRule $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $now = Carbon::create(2026, 10, 15, 12, 35);
        Carbon::setTestNow($now);

        $this->rule = new AfterDate(Carbon::today());
    }

    #[DataProvider('expectations')]
    public function test(
        ?int $day,
        ?int $month,
        ?int $year,
        ?string $time,
        Carbon|string $expected,
    ): void {
        $this->assertEquals(
            $expected,
            $this->rule->parseDate($day, $month, $year, $time),
        );
    }

    public static function expectations(): array
    {
        return [
            [
                'day' => null,
                'month' => null,
                'year' => null,
                'time' => null,
                'expected' => 'Provide a date for :attribute',
            ],
            [
                'day' => null,
                'month' => null,
                'year' => 2026,
                'time' => null,
                'expected' => Carbon::create(2026, 10, 15, 12, 35),
            ],
            [
                'day' => 15,
                'month' => 10,
                'year' => null,
                'time' => '13:35',
                'expected' => Carbon::create(2026, 10, 15, 12, 35),
            ],
        ];
    }
}
