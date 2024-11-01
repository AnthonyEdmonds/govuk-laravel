<?php

namespace AnthonyEdmonds\GovukLaravel\Helpers;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class GovukDate
{
    public static function parse(FormRequest|array $request, string $dateKey, ?string $timeKey = null): Carbon
    {
        $date = self::parseDate($request, $dateKey);

        if ($timeKey !== null) {
            $time = self::parseTime($request, $timeKey);
            $date->setTimeFrom($time);
        }

        return $date;
    }

    public static function parseDate(FormRequest|array $request, string $key): Carbon
    {
        $day = $request["$key-day"];
        $month = $request["$key-month"];
        $year = $request["$key-year"];

        $dayFormat = strlen($day) < 2 ? 'j' : 'd';
        $monthFormat = strlen($month) < 2 ? 'n' : 'm';
        $yearFormat = strlen($year) < 4 ? 'y' : 'Y';

        return Carbon::createFromFormat("$yearFormat-$monthFormat-$dayFormat", "$year-$month-$day")->setTime(0, 0);
    }

    public static function parseTime(FormRequest|array $request, string $key): Carbon
    {
        return Carbon::parse($request[$key]);
    }
}
