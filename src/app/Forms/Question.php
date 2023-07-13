<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Questions\Question as GovukQuestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class Question
{
    const LOOPS = false;

    const SKIPPABLE = false;

    // Abstract
    abstract public static function key(): string;

    abstract public function getQuestion(Model $subject): GovukQuestion|array;

    abstract public function store(Request $request, Model $subject, string $mode): void;

    abstract protected function getFormRequest(): FormRequest;

    // Utilities
    public function getTitle(Model $subject): string
    {
        return '';
    }

    public function validate(Request $request, Model $subject): void
    {
        $formRequest = $this->getFormRequest();
        $formRequest->subject = $subject;

        Validator::make(
            $request->all(),
            $formRequest->rules(), /* @phpstan-ignore-line */
            $formRequest->messages()
        )->validate();
    }

    public function skip(Model $subject, string $mode): void
    {
        //
    }

    public function getMethod(): string
    {
        return Page::POST_METHOD;
    }

    public function getBlade(): ?string
    {
        return null;
    }

    public function getOtherButtonLabel(): ?string
    {
        return static::SKIPPABLE === true
            ? 'Skip and continue'
            : null;
    }

    public function getOtherButtonRoute(Form $form, string $mode): ?string
    {
        return static::SKIPPABLE === true
            ? $form::skipRoute($mode, static::key())
            : null;
    }

    public function getOtherButtonMethod(): string
    {
        return Page::POST_METHOD;
    }

    public function getSubmitButtonLabel(string $mode, bool $isLastQuestion = false): string
    {
        if ($mode === Form::REVIEW || $mode === Form::EDIT) {
            return 'Save and back';
        }

        if ($isLastQuestion === true) {
            return 'Save and review';
        }

        return 'Save and continue';
    }

    public function getSubmitButtonType(): string
    {
        return Page::NORMAL_BUTTON;
    }
}
