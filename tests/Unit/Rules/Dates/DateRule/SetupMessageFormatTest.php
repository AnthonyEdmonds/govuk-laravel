<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates\DateRule;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\AfterDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\DateRule;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\DataProvider;

class SetupMessageFormatTest extends TestCase
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
        $this->rule->setupMessageFormat($day, $month, $year, $time);

        $this->assertEquals(
            $expected,
            $this->rule->messageFormat,
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
                'expected' => '',
            ],
            [
                'day' => 1,
                'month' => 2,
                'year' => 3,
                'time' => '12:56',
                'expected' => 'd/m/Y H:i',
            ],
            [
                'day' => 1,
                'month' => null,
                'year' => null,
                'time' => '12:56',
                'expected' => 'd H:i',
            ],
            [
                'day' => 1,
                'month' => 2,
                'year' => null,
                'time' => '12:56',
                'expected' => 'd/m H:i',
            ],
            [
                'day' => null,
                'month' => 2,
                'year' => 3,
                'time' => '12:56',
                'expected' => 'm/Y H:i',
            ],
            [
                'day' => 1,
                'month' => null,
                'year' => 3,
                'time' => '12:56',
                'expected' => 'd/Y H:i',
            ],
            [
                'day' => 1,
                'month' => 2,
                'year' => 3,
                'time' => null,
                'expected' => 'd/m/Y',
            ],
        ];
    }
}
