<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates\DateRule;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\AfterDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\DateRule;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\DataProvider;

class GetTimePartTest extends TestCase
{
    protected DateRule $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new AfterDate(Carbon::today());

        $this->rule->setData([
            'time' => '12:56',
        ]);
    }

    #[DataProvider('expectations')]
    public function test(
        string $key,
        ?string $expected,
    ): void {
        $this->assertEquals(
            $expected,
            $this->rule->getTimePart($key),
        );
    }

    public static function expectations(): array
    {
        return [
            [
                'key' => 'missing',
                'expected' => null,
            ],
            [
                'key' => 'time',
                'expected' => '12:56',
            ],
        ];
    }
}
