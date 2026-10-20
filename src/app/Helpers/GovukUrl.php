<?php

namespace AnthonyEdmonds\GovukLaravel\Helpers;

class GovukUrl
{
    public static function resolvePathFromConfig(string $key): string
    {
        $logoPath = config($key);

        return match (true) {
            str_contains($logoPath, '://') === true => $logoPath,
            str_contains($logoPath, '/') === true => asset($logoPath),
            default => route($logoPath),
        };
    }
}
