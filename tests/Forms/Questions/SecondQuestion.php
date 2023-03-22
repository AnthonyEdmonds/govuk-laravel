<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions;

use AnthonyEdmonds\GovukLaravel\Forms\Question;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion as GovukQuestionHelper;
use AnthonyEdmonds\GovukLaravel\Questions\Question as GovukQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\FormRequests\NameFormRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SecondQuestion extends Question
{
    public static function key(): string
    {
        return 'second-question';
    }

    public function getTitle(Model $subject): string
    {
        return 'The Second Question';
    }

    public function getQuestion(Model $subject): GovukQuestion|array
    {
        return [
            GovukQuestionHelper::input(
                'Test question two A',
                self::key().'-a',
            ),
            GovukQuestionHelper::input(
                'Test question two B',
                self::key().'-b',
            ),
        ];
    }

    public function store(Request $request, Model $subject, string $mode): void
    {
        $subject->name = $request->name;
    }

    protected function getFormRequest(): FormRequest
    {
        return new NameFormRequest();
    }
}
