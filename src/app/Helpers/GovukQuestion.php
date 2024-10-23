<?php

namespace AnthonyEdmonds\GovukLaravel\Helpers;

use AnthonyEdmonds\GovukLaravel\Questions\Question;
use Illuminate\Support\Collection;

class GovukQuestion
{
    public static function checkboxes(
        string $label,
        string $name,
        array|Collection $options,
        ?string $id = null,
    ): Question {
        return Question::create($label, $name, Question::CHECKBOXES, $id)
            ->options($options);
    }

    public static function date(
        string $label,
        string $name,
        ?string $id = null,
    ): Question {
        return Question::create($label, $name, Question::DATE, $id);
    }

    public static function file(
        string $label,
        string $name,
        string $accept = '*',
        ?string $id = null,
    ): Question {
        return Question::create(
            $label,
            $name,
            Question::FILE,
            $id,
        )
            ->accept($accept);
    }

    public static function hidden(
        string $name,
        ?string $value,
        ?string $id = null,
    ): Question {
        return Question::create(
            '',
            $name,
            Question::HIDDEN,
            $id,
        )
            ->value($value ?? '');
    }

    public static function input(
        string $label,
        string $name,
        string $type = 'text',
        ?string $id = null,
    ): Question {
        return Question::create(
            $label,
            $name,
            Question::TEXT_INPUT,
            $id,
        )
            ->type($type);
    }

    public static function new(string $type, array $settings): Question
    {
        return Question::create($settings['label'], $settings['name'], $type)
            ->fromArray($settings);
    }

    public static function password(
        string $label,
        string $name,
        ?string $id = null,
    ): Question {
        return Question::create(
            $label,
            $name,
            Question::PASSWORD,
            $id,
        );
    }

    public static function radios(
        string $label,
        string $name,
        array|Collection $options,
        ?string $id = null,
    ): Question {
        return Question::create(
            $label,
            $name,
            Question::RADIOS,
            $id,
        )
            ->options($options);
    }

    public static function select(
        string $label,
        string $name,
        array|Collection $options,
        ?string $id = null,
    ): Question {
        return Question::create(
            $label,
            $name,
            Question::SELECT,
            $id,
        )
            ->options($options);
    }

    public static function textarea(
        string $label,
        string $name,
        ?string $id = null,
    ): Question {
        return Question::create(
            $label,
            $name,
            Question::TEXT_AREA,
            $id,
        );
    }

    public static function time(
        string $label,
        string $name,
        ?string $id = null,
    ): Question {
        return Question::create(
            $label,
            $name,
            Question::TIME,
            $id,
        );
    }

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
