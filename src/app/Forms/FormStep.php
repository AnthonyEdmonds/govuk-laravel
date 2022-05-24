<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use Illuminate\Contracts\View\View;

abstract class FormStep implements View
{
    public const BLADE = null;
    public const TITLE = null;

    protected string $stepKey;
    protected array $withs;

    // Construction
    public function __construct()
    {

    }

    abstract public function page(): View;

    abstract public function nextRoute(): string;

    abstract public function backRoute(): string;

    // View Contract
    public function render(): string
    {
        return $this->page()->render();
    }

    public function name(): string
    {
        return $this->stepKey;
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
