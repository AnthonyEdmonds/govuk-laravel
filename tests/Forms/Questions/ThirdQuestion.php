<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions;

use AnthonyEdmonds\GovukLaravel\Forms\Question;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion as GovukQuestionHelper;
use AnthonyEdmonds\GovukLaravel\Questions\Question as GovukQuestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\FormRequests\NameFormRequest;

class ThirdQuestion extends Question
{
    public static function key(): string
    {
        return 'third-question';
    }

    public function getQuestion(Model $subject): GovukQuestion|array
    {
        return GovukQuestionHelper::input(
            'Test question three',
            self::key(),
        );
    }

    public function store(Request $request, Model $subject): void
    {
        $subject->name = $request->name;
    }

    public function update(Request $request, Model $subject): void
    {
        $subject->name = $request->name;
    }

    protected function getFormRequest(): FormRequest
    {
        return new NameFormRequest();
    }
}
