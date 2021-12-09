<?php

namespace AnthonyEdmonds\GovukLaravel\Helpers;

use AnthonyEdmonds\GovukLaravel\Questions\Question;

class GovukQuestion
{
    public static function checkboxes(): Question
    {
        // TODO
        return Question::create('incomplete', 'not ready', 'aargh');
    }

    public static function hidden(
        string $name,
        string $value,
        string $id = null
    ): Question {
        return Question::create(
            '',
            $name,
            Question::HIDDEN,
            $id
        )
            ->value($value);
    }

    public static function input(
        string $label,
        string $name,
        string $type = 'text',
        string $id = null
    ): Question {
        return Question::create(
            $label,
            $name,
            Question::TEXT_INPUT,
            $id
        )
            ->type($type);
    }

    public static function radios(
        string $label,
        string $name,
        array $options,
        string $id = null
    ): Question {
        return Question::create(
            $label,
            $name,
            Question::RADIOS,
            $id
        )
            ->options($options);
    }

    public static function select(
        string $label,
        string $name,
        array $options,
        string $id = null
    ): Question {
        return Question::create(
            $label,
            $name,
            Question::SELECT,
            $id
        )
            ->options($options);
    }

    public static function textarea(
        string $label,
        string $name,
        string $id = null
    ): Question {
        return Question::create(
            $label,
            $name,
            Question::TEXT_AREA,
            $id
        );
    }
}
