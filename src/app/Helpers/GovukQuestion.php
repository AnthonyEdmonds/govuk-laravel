<?php

namespace AnthonyEdmonds\GovukLaravel\Helpers;

use AnthonyEdmonds\GovukLaravel\Questions\Question;

class GovukQuestion
{
    public static function checkboxes(): Question
    {
        // TODO
    }
    
    public static function hidden(
        string $label,
        string $name,
        string $value,
        string $id = null
    ): Question
    {
        return Question::create(
            $label,
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
    ): Question
    {
        return Question::create(
            $label,
            $name,
            Question::TEXT_INPUT,
            $id
        )
            ->type($type);
    }
    
    public static function radios(): Question
    {
        // TODO
    }
    
    public static function select(): Question
    {
        // TODO
    }
    
    public static function textarea(
        string $label,
        string $name,
        string $id = null
    ): Question
    {
        return Question::create(
            $label,
            $name,
            Question::TEXT_AREA,
            $id
        );
    }
}
