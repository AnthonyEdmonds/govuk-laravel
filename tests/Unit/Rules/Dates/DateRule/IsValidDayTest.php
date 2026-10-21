<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates\DateRule;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\AfterDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\DateRule;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\DataProvider;

class IsValidDayTest extends TestCase
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
        ?string $expected,
    ): void {
        $this->assertEquals(
            $expected,
            $this->rule->isValidDay($day),
        );
    }

    public static function expectations(): array
    {
        return [
            [
                'day' => null,
                'expected' => null,
            ],
            [
                'day' => 12,
                'expected' => null,
            ],
            [
                'day' => 123,
                'expected' => ':Attribute day must be one or two digits long',
            ],
            [
                'day' => 0,
                'expected' => ':Attribute day must be between 1 and 31',
            ],
            [
                'day' => 32,
                'expected' => ':Attribute day must be between 1 and 31',
            ],
        ];
    }
}
