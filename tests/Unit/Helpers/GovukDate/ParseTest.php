<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukDate;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukDate;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use PHPUnit\Framework\Attributes\DataProvider;

class ParseTest extends TestCase
{
    #[DataProvider('formats')]
    public function test(
        FormRequest|array $data,
        Carbon $expectation,
        ?string $timeKey,
        Carbon $now,
    ): void {
        Carbon::setTestNow($now);

        $date = GovukDate::parse($data, 'date', $timeKey);

        $this->assertTrue(
            $expectation->equalTo($date),
        );
    }

    public static function formats(): array
    {
        return [
            'long_array' => [
                'data' => [
                    'date-day' => 28,
                    'date-month' => 3,
                    'date-year' => 2026,
                ],
                'now' => Carbon::create(2026, 3, 28, timezone: 'Europe/London'),
                'expectation' => Carbon::create(2026, 3, 28, timezone: 'UTC'),
                'timeKey' => null,
            ],
            'short_array' => [
                'data' => [
                    'date-day' => 28,
                    'date-month' => 3,
                    'date-year' => 26,
                    'time' => '3:10pm',
                ],
                'now' => Carbon::create(2026, 3, 28, timezone: 'Europe/London'),
                'expectation' => Carbon::create(2026, 3, 28, 15, 10, timezone: 'UTC'),
                'timeKey' => 'time',
            ],
            'form_request' => [
                'data' => new FormRequest([
                    'date-day' => 28,
                    'date-month' => 3,
                    'date-year' => 26,
                    'time' => '1am',
                ]),
                'now' => Carbon::create(2026, 3, 28, timezone: 'Europe/London'),
                'expectation' => Carbon::create(2026, 3, 28, 1, timezone: 'UTC'),
                'timeKey' => 'time',
            ],
            'timezone' => [
                'data' => [
                    'date-day' => 30,
                    'date-month' => 3,
                    'date-year' => 2026,
                    'time' => '01:00',
                ],
                'now' => Carbon::create(2026, 3, 30, timezone: 'Europe/London'),
                'expectation' => Carbon::create(2026, 3, 30, timezone: 'UTC'),
                'timeKey' => 'time',
            ],
            'date-rolls-back' => [
                'data' => [
                    'date-day' => 30,
                    'date-month' => 3,
                    'date-year' => 2026,
                    'time' => '00:00',
                ],
                'now' => Carbon::create(2026, 3, 30, timezone: 'Europe/London'),
                'expectation' => Carbon::create(2026, 3, 29, 23, timezone: 'UTC'),
                'timeKey' => 'time',
            ],
        ];
    }
}
