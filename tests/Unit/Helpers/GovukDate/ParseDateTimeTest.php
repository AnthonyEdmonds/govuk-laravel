<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukDate;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukDate;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use PHPUnit\Framework\Attributes\DataProvider;

class ParseDateTimeTest extends TestCase
{
    #[DataProvider('expectations')]
    public function test(
        string $day,
        string $month,
        string $year,
        string $time,
        Carbon $expected,
    ): void {
        $request = new FormRequest([
            'date-day' => $day,
            'date-month' => $month,
            'date-year' => $year,
            'time' => $time,
        ]);

        $this->assertTrue(
            GovukDate::parseDateTime($request, 'date', 'time')
                ->equalTo($expected),
        );
    }

    public static function expectations(): array
    {
        return [
            'daylight-savings' => [
                'day' => '29',
                'month' => '3',
                'year' => '2026',
                'time' => '14:00',
                'expected' => Carbon::create(2026, 3, 29, 13, timezone: 'UTC'),
            ],
            'standard' => [
                'day' => '28',
                'month' => '3',
                'year' => '2026',
                'time' => '14:00',
                'expected' => Carbon::create(2026, 3, 28, 14, timezone: 'UTC'),
            ],
        ];
    }
}
