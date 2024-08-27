<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions;

use AnthonyEdmonds\GovukLaravel\Forms\Question;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion as GovukQuestionHelper;
use AnthonyEdmonds\GovukLaravel\Questions\Question as GovukQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\FormRequests\NameFormRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FirstQuestion extends Question
{
    const SKIPPABLE = true;

    public static function key(): string
    {
        return 'first-question';
    }

    public function getQuestion(Model $subject): GovukQuestion|array
    {
        return GovukQuestionHelper::input(
            'Test question one',
            self::key(),
        );
    }

    public function store(Request $request, Model $subject, string $mode): void
    {
        $subject->name = $request->name;
    }

    public function skip(Model $subject, string $mode): void
    {
        $subject->name = 'Skipped';
    }

    public function withs(Model $subject): array
    {
        return [
            'name' => 'Tom',
            'surname' => 'Paris',
            'pet' => 'dog',
        ];
    }

    protected function getFormRequest(): FormRequest
    {
        return new NameFormRequest;
    }
}
