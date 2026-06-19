<?php

namespace AnthonyEdmonds\GovukLaravel\Helpers;

use Carbon\Carbon;
use DateException;
use Deprecated;
use Illuminate\Foundation\Http\FormRequest;

class GovukDate
{
    public const array TIME_FORMATS = [
        '12:00' => 'H:i',
        '05:00pm' => 'h:ia',
        '5:00pm' => 'g:ia',
        '05am' => 'ha',
        '5am' => 'ga',
    ];

    #[Deprecated('Use parseDateTime instead; will be removed in 9.x')]
    public static function parse(
        FormRequest|array $request,
        string $dateKey,
        ?string $timeKey = null,
        string $inputTimezone = 'Europe/London',
        string $outputTimezone = 'UTC',
    ): Carbon {
        if ($timeKey === null) {
            $timeKey = 'time';
            is_array($request) === true
                ? $request['time'] = '00:00'
                : $request->query->set('time', '00:00');
        }

        return self::parseDateTime($request, $dateKey, $timeKey, $inputTimezone, $outputTimezone);
    }

    public static function parseDateTime(
        FormRequest|array $request,
        string $dateKey,
        string $timeKey,
        string $inputTimezone = 'Europe/London',
        string $outputTimezone = 'UTC',
    ): Carbon {
        $date = self::standardiseDate($request, $dateKey);
        $time = self::standardiseTime($request, $timeKey);

        return Carbon::createFromFormat(
            'Y-m-d H:i',
            "$date $time",
            $inputTimezone,
        )->setTimezone($outputTimezone);
    }

    public static function parseDate(
        FormRequest|array $request,
        string $key,
    ): Carbon {
        return Carbon::createFromFormat(
            'Y-m-d',
            self::standardiseDate($request, $key),
            'UTC',
        )->setTime(0, 0);
    }

    public static function parseTime(
        FormRequest|array $request,
        string $key,
        string $inputTimezone = 'Europe/London',
        string $outputTimezone = 'UTC',
    ): Carbon {
        return Carbon::createFromFormat(
            'H:i',
            self::standardiseTime($request, $key),
            $inputTimezone,
        )->setTimezone($outputTimezone);
    }

    public static function standardiseDate(FormRequest|array $request, string $key): string
    {
        $day = $request["$key-day"];
        $month = $request["$key-month"];
        $year = $request["$key-year"];

        $dayFormat = strlen($day) < 2 ? 'j' : 'd';
        $monthFormat = strlen($month) < 2 ? 'n' : 'm';
        $yearFormat = strlen($year) < 4 ? 'y' : 'Y';

        return Carbon::createFromFormat(
            "$yearFormat-$monthFormat-$dayFormat",
            "$year-$month-$day",
        )->format('Y-m-d');
    }

    public static function standardiseTime(FormRequest|array $request, string $key): string
    {
        $time = $request[$key];
        $time = str_replace(' ', '', $time);
        $time = strtolower($time);

        foreach (self::TIME_FORMATS as $format) {
            if (Carbon::canBeCreatedFromFormat($time, $format) === true) {
                return Carbon::createFromFormat($format, $time)->format('H:i');
            }
        }

        throw new DateException("\"$time\" is not in a recognised time format");
    }
}
