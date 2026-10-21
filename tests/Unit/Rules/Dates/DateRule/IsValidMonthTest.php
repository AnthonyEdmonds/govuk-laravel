<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates\DateRule;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\AfterDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\DateRule;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\DataProvider;

class IsValidMonthTest extends TestCase
{
    protected DateRule $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new AfterDate(Carbon::today());
    }

    #[DataProvider('expectations')]
    public function test(
        ?int $month,
        ?string $expected,
    ): void {
        $this->assertEquals(
            $expected,
            $this->rule->isValidMonth($month),
        );
    }

    public static function expectations(): array
    {
        return [
            [
                'month' => null,
                'expected' => null,
            ],
            [
                'month' => 12,
                'expected' => null,
            ],
            [
                'month' => 123,
                'expected' => ':Attribute month must be one or two digits long',
            ],
            [
                'month' => 0,
                'expected' => ':Attribute month must be between 1 and 12',
            ],
            [
                'month' => 13,
                'expected' => ':Attribute month must be between 1 and 12',
            ],
        ];
    }
}
