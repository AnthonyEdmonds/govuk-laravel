<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Forms;

use AnthonyEdmonds\GovukLaravel\Forms\FormStep;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion;
use AnthonyEdmonds\GovukLaravel\Questions\Question;

class TestFormStepQuestion extends FormStep
{
    public function question(): array|Question
    {
        return GovukQuestion::input(
            'My question?',
            'question'
        );
    }

    public function store(): void
    {
        // TODO: Implement store() method.
    }

    public function update(): void
    {
        // TODO: Implement update() method.
    }
}
