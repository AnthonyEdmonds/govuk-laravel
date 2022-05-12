<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Forms;

use AnthonyEdmonds\GovukLaravel\Forms\FormStep;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion;
use AnthonyEdmonds\GovukLaravel\Questions\Question;

class TestFormStepQuestions extends FormStep
{
    const TITLE = 'What are the answers?';
    
    public function question(): array|Question
    {
        return [
            GovukQuestion::input(
                'My question',
                'question-1'
            ),
            GovukQuestion::input(
                'My other question',
                'question-2'
            )
        ];
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
