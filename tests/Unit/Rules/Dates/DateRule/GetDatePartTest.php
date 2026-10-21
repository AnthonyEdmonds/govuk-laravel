<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates\DateRule;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\AfterDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\DateRule;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\DataProvider;

class GetDatePartTest extends TestCase
{
    protected DateRule $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new AfterDate(Carbon::today());
    }

    #[DataProvider('expectations')]
    public function test(
        int|string|null $value,
        ?int $expected,
    ): void {
        $this->rule->setData([
            'test-day' => $value,
        ]);

        $this->assertEquals(
            $expected,
            $this->rule->getDatePart('test', 'day'),
        );
    }

    public static function expectations(): array
    {
        return [
            [
                'value' => null,
                'expected' => null,
            ],
            [
                'value' => '',
                'expected' => null,
            ],
            [
                'value' => 'qwerty',
                'expected' => null,
            ],
            [
                'value' => '1.1',
                'expected' => 1,
            ],
            [
                'value' => '1',
                'expected' => 1,
            ],
            [
                'value' => 1,
                'expected' => 1,
            ],
        ];
    }
}
