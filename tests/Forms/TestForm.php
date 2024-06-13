<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Forms;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\SecondQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\ThirdQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TestForm extends Form
{
    public static function key(): string
    {
        return 'test-form';
    }

    public function checkAccess(Model $subject): void
    {
        Gate::allowIf(Auth::user()->allow === true);
    }

    public function questions(): array
    {
        return [
            FirstQuestion::class,
            SecondQuestion::class,
            ThirdQuestion::class,
        ];
    }

    protected function makeNewSubject(): Model
    {
        return new FormModel();
    }

    protected function submitForm(Model $subject, string $mode): void
    {
        $subject->save();
    }

    protected function submitDraft(Model $subject, string $mode): void
    {
        $subject->save();
    }

    public function confirmationBlade(): string|false
    {
        return 'test.confirmation';
    }

    public function startBlade(): string|false
    {
        return 'test.start';
    }

    protected function summaryDraftLabel(Model $subject): ?string
    {
        return 'Save as draft';
    }
}
