<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates\DateRule;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\AfterDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\DateRule;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\DataProvider;

class GetTimeFieldTest extends TestCase
{
    protected DateRule $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new AfterDate(Carbon::today());
    }

    #[DataProvider('expectations')]
    public function test(
        ?string $initial,
        bool $inData,
        ?string $expected,
    ): void {
        if ($inData === true) {
            $this->rule->setData([
                'test-time' => '12:56',
            ]);
        }

        $this->assertEquals(
            $expected,
            $this->rule->getTimeField('test', $initial),
        );
    }

    public static function expectations(): array
    {
        return [
            [
                'initial' => null,
                'inData' => false,
                'expected' => null,
            ],
            [
                'initial' => 'time',
                'inData' => false,
                'expected' => 'time',
            ],
            [
                'initial' => null,
                'inData' => true,
                'expected' => 'test-time',
            ],
        ];
    }
}
