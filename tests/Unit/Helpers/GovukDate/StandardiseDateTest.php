<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukDate;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukDate;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Foundation\Http\FormRequest;
use PHPUnit\Framework\Attributes\DataProvider;

class StandardiseDateTest extends TestCase
{
    #[DataProvider('expectations')]
    public function test(
        string $day,
        string $month,
        string $year,
        string $expected,
    ): void {
        $request = new FormRequest([
            'date-day' => $day,
            'date-month' => $month,
            'date-year' => $year,
        ]);

        $this->assertEquals(
            $expected,
            GovukDate::standardiseDate($request, 'date'),
        );
    }

    public static function expectations(): array
    {
        return [
            [
                'day' => '1',
                'month' => '3',
                'year' => '26',
                'expected' => '2026-03-01',
            ],
            [
                'day' => '01',
                'month' => '03',
                'year' => '2026',
                'expected' => '2026-03-01',
            ],
        ];
    }
}
