<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use AnthonyEdmonds\GovukLaravel\Pages\Page;

abstract class Question
{
    public function getOtherButtonRoute(Form $form, string $mode): ?string
    {
        return static::SKIPPABLE === true
            ? $form::skipRoute($mode, static::key())
            : null;
    }
    
    public function getSubmitButtonType(): string
    {
        return Page::NORMAL_BUTTON;
    }
}
