<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Dates\DateRule;

use AnthonyEdmonds\GovukLaravel\Rules\Dates\AfterDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\DateRule;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use PHPUnit\Framework\Attributes\DataProvider;

class IsNullTest extends TestCase
{
    protected DateRule $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new AfterDate(Carbon::today());
    }

    #[DataProvider('expectations')]
    public function test(
        bool $nullable,
        ?int $day,
        ?int $month,
        ?int $year,
        bool $expected,
    ): void {
        $this->rule->setValidator(
            new Validator(
                app(Translator::class),
                [],
                [
                    'test' => [
                        $nullable === true
                            ? Rule::nullable()
                            : null,
                    ],
                ],
            ),
        );

        $this->assertEquals(
            $expected,
            $this->rule->isNull('test', $day, $month, $year),
        );
    }

    public static function expectations(): array
    {
        return [
            [
                'nullable' => true,
                'day' => null,
                'month' => null,
                'year' => null,
                'expected' => true,
            ],
            [
                'nullable' => true,
                'day' => 1,
                'month' => null,
                'year' => null,
                'expected' => false,
            ],
            [
                'nullable' => true,
                'day' => null,
                'month' => 1,
                'year' => null,
                'expected' => false,
            ],
            [
                'nullable' => true,
                'day' => null,
                'month' => null,
                'year' => 1,
                'expected' => false,
            ],
            [
                'nullable' => false,
                'day' => null,
                'month' => null,
                'year' => null,
                'expected' => false,
            ],
        ];
    }
}
