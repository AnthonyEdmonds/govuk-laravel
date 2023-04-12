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
            $formRequest->rules(),
            $formRequest->messages()
        )->validate();
    }

    public function getMethod(): string
    {
        return 'post';
    }

    public function getBlade(): string|null
    {
        return null;
    }

    public function getOtherButtonLabel(): string|null
    {
        return null;
    }

    public function getOtherButtonRoute(): string|null
    {
        return null;
    }

    public function getSubmitButtonType(): string
    {
        return Page::NORMAL_BUTTON;
    }
}
