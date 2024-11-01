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
    public function test(FormRequest|array $data, Carbon $expectation, ?string $timeKey): void
    {
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
                    'date-day' => 15,
                    'date-month' => 10,
                    'date-year' => 2024,
                ],
                'expectation' => Carbon::create(2024, 10, 15),
                'timeKey' => null,
            ],
            'short_array' => [
                'data' => [
                    'date-day' => 5,
                    'date-month' => 9,
                    'date-year' => 24,
                    'time' => '3:10pm',
                ],
                'expectation' => Carbon::create(2024, 9, 5, 15, 10),
                'timeKey' => 'time',
            ],
            'form_request' => [
                'data' => new FormRequest([
                    'date-day' => 5,
                    'date-month' => 9,
                    'date-year' => 24,
                    'time' => '1am',
                ]),
                'expectation' => Carbon::create(2024, 9, 5, 1),
                'timeKey' => 'time',
            ],
        ];
    }
}
