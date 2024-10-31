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
    public function test(FormRequest|array $data, Carbon $expectation): void
    {
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
                'expectation' => Carbon::now()->setTime(15, 10),
            ],
            'short_array' => [
                'data' => [
                    'time' => '3:10pm',
                ],
                'expectation' => Carbon::now()->setTime(15, 10),
            ],
            'form_request' => [
                'data' => new FormRequest([
                    'time' => '1am',
                ]),
                'expectation' => Carbon::now()->setTime(1, 0),
            ],
        ];
    }
}
