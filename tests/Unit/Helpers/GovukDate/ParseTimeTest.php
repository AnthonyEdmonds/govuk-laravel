<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukDate;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukDate;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use PHPUnit\Framework\Attributes\DataProvider;

class ParseTimeTest extends TestCase
{
    #[DataProvider('formats')]
    public function test(
        FormRequest|array $data,
        Carbon $expectation,
        Carbon $now,
    ): void {
        Carbon::setTestNow($now);

        $date = GovukDate::parseTime($data, 'time');

        $this->assertTrue(
            $expectation->equalTo($date),
        );
    }

    public static function formats(): array
    {
        return [
            'long_array' => [
                'data' => [
                    'time' => '15:10',
                ],
                'now' => Carbon::create(2026, 3, 28, timezone: 'Europe/London'),
                'expectation' => Carbon::create(2026, 3, 28, 15, 10, timezone: 'UTC'),
            ],
            'short_array' => [
                'data' => [
                    'time' => '3:10pm',
                ],
                'now' => Carbon::create(2026, 3, 28, timezone: 'Europe/London'),
                'expectation' => Carbon::create(2026, 3, 28, 15, 10, timezone: 'UTC'),
            ],
            'form_request' => [
                'data' => new FormRequest([
                    'time' => '1am',
                ]),
                'now' => Carbon::create(2026, 3, 28, timezone: 'Europe/London'),
                'expectation' => Carbon::create(2026, 3, 28, 1, timezone: 'UTC'),
            ],
            'timezone' => [
                'data' => [
                    'time' => '01:00',
                ],
                'now' => Carbon::create(2026, 3, 30, timezone: 'Europe/London'),
                'expectation' => Carbon::create(2026, 3, 30, timezone: 'UTC'),
            ],
        ];
    }
}
