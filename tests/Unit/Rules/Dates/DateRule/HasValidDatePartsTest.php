<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates\DateRule;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\AfterDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\DateRule;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\DataProvider;

class HasValidDatePartsTest extends TestCase
{
    protected DateRule $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new AfterDate(Carbon::today());
    }

    #[DataProvider('expectations')]
    public function test(
        ?int $day,
        ?int $month,
        ?int $year,
        ?string $time,
        ?string $expected,
    ): void {
        $this->assertEquals(
            $expected,
            $this->rule->hasValidDateParts($day, $month, $year, $time),
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
                'day' => 1,
                'month' => 2,
                'year' => 2026,
                'time' => '12:56',
                'expected' => null,
            ],
            [
                'day' => 123,
                'month' => 2,
                'year' => 2026,
                'time' => '12:56',
                'expected' => ':Attribute day must be one or two digits long',
            ],
            [
                'day' => 1,
                'month' => 253,
                'year' => 2026,
                'time' => '12:56',
                'expected' => ':Attribute month must be one or two digits long',
            ],
            [
                'day' => 1,
                'month' => 2,
                'year' => 2,
                'time' => '12:56',
                'expected' => ':Attribute year must be two or four digits long',
            ],
            [
                'day' => 1,
                'month' => 2,
                'year' => 2026,
                'time' => '60:60',
                'expected' => ':Attribute is not a valid time',
            ],
        ];
    }
}
