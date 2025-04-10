<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Questions\Question as GovukQuestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

abstract class Question
{
    public const bool LOOPS = false;

    public const bool SKIPPABLE = false;

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
        request()->merge([
            'subject' => $subject,
        ]);
        app($this->getFormRequest()::class);
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

    public function getOtherButtonLabel(?Model $subject = null): ?string
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

    public function getSubmitButtonMode(): string
    {
        return Page::NORMAL_BUTTON;
    }

    public function withs(Model $subject): array
    {
        return [];
    }
}
