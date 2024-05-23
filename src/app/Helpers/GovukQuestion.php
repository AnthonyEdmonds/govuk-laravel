<?php

namespace AnthonyEdmonds\GovukLaravel\Helpers;

use AnthonyEdmonds\GovukLaravel\Questions\Question;

class GovukQuestion
{
    public static function dotsToBrackets(string $name): string
    {
        if (str_contains($name, '.') === false) {
            return $name;
        }

        $pieces = explode('.', $name);
        $name = '';

        foreach ($pieces as $piece) {
            $name .= $name === ''
                ? $piece
                : "[$piece]";
        }

        return $name;
    }

    public static function bracketsToDots(string $name): string
    {
        if (str_contains($name, '[') === false || str_contains($name, ']') === false) {
            return $name;
        }

        $name = str_replace(']', '', $name);
        $pieces = explode('[', $name);
        $name = '';

        foreach ($pieces as $piece) {
            $name .= $name === ''
                ? $piece
                : ".$piece";
        }

        return $name;
    }
}
