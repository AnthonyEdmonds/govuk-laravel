<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Questions\Question;
use Illuminate\Contracts\View\View;

abstract class FormStepOld implements View
{
    public const KEY = 'form-step';
    public const BLADE = null;
    public const BUTTON_LABEL = 'Continue';
    public const TITLE = null;

    protected string $formClass;
    protected array $withs;

    // Construction
    public function __construct(string $formClass)
    {
        $this->formClass = $formClass;
    }

    // Question
    abstract public function question(): array|Question;

    abstract public function store(): void;

    abstract public function update(): void;

    // Routes
    public static function route(string $formClass): string
    {
        return route($formClass::getRouteBase().'create', [static::KEY]);
    }

    public function getRoute(): string
    {
        return route($this->formClass::getRouteBase().'create', [static::KEY]);
    }

    protected function backRoute(): string
    {
        return $this->formClass::getPreviousRoute(static::KEY);
    }

    // View Contract
    public function render(): string
    {
        $question = $this->question();

        return $question instanceof Question === true
            ? GovukPage::question(
                $question,
                static::BUTTON_LABEL,
                $this->getRoute(),
                $this->backRoute(),
                'POST',
                static::BLADE,
            )->render()
            : GovukPage::questions(
                static::TITLE,
                $question,
                static::BUTTON_LABEL,
                $this->getRoute(),
                $this->backRoute(),
                'POST',
                static::BLADE,
            )->render();
    }

    public function name(): string
    {
        return static::KEY;
    }

    public function with($key, $value = null): static
    {
        $this->withs[$key] = $value;
        return $this;
    }

    public function getData(): array
    {
        return array_merge(
            [],
            $this->withs
        );
    }
}
