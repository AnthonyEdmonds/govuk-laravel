<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukDate;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukDate;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use DateException;
use Illuminate\Foundation\Http\FormRequest;
use PHPUnit\Framework\Attributes\DataProvider;

class StandardiseTimeTest extends TestCase
{
    #[DataProvider('expectations')]
    public function test(
        string $time,
        string $expected,
    ): void {
        $request = new FormRequest([
            'time' => $time,
        ]);

        $this->assertEquals(
            $expected,
            GovukDate::standardiseTime($request, 'time'),
        );
    }

    public function testThrowsException(): void
    {
        $this->expectException(DateException::class);
        $this->expectExceptionMessage('"potato" is not in a recognised time format');

        $request = new FormRequest([
            'time' => 'potato',
        ]);

        GovukDate::standardiseTime($request, 'time');
    }

    public static function expectations(): array
    {
        return [
            [
                'time' => '17:32',
                'expected' => '17:32',
            ],
            [
                'time' => '05:32PM',
                'expected' => '17:32',
            ],
            [
                'time' => '5:32pm',
                'expected' => '17:32',
            ],
            [
                'time' => '05PM',
                'expected' => '17:00',
            ],
            [
                'time' => '5pm',
                'expected' => '17:00',
            ],
        ];
    }
}
