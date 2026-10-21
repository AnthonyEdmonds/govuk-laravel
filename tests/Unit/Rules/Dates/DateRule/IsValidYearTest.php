<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates\DateRule;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\AfterDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\DateRule;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\DataProvider;

class IsValidYearTest extends TestCase
{
    protected DateRule $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new AfterDate(Carbon::today());
    }

    #[DataProvider('expectations')]
    public function test(
        ?int $year,
        ?string $expected,
    ): void {
        $this->assertEquals(
            $expected,
            $this->rule->isValidYear($year),
        );
    }

    public static function expectations(): array
    {
        return [
            [
                'year' => null,
                'expected' => null,
            ],
            [
                'year' => 2026,
                'expected' => null,
            ],
            [
                'year' => 1,
                'expected' => ':Attribute year must be two or four digits long',
            ],
            [
                'year' => 12345,
                'expected' => ':Attribute year must be two or four digits long',
            ],
        ];
    }
}
