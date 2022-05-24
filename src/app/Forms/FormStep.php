<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Questions\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

abstract class FormStep implements View
{
    public const BLADE = null;
    public const BUTTON_LABEL = 'Continue';
    public const TITLE = null;

    protected Model|array $data;
    protected string $formClass;
    protected string $stepKey;
    protected array $withs;

    // Construction
    public function __construct(string $formClass, string $stepKey, Model|array $data)
    {
        $this->data = $data;
        $this->formClass = $formClass;
        $this->stepKey = $stepKey;
    }

    // Question
    abstract public function question(Model|array $data): array|Question;

    abstract public function save(Model|array $data): Model|array;

    // View Contract
    public function render(): string
    {
        $question = $this->question($this->data);

        return $question instanceof Question === true
            ? GovukPage::question(
                $question,
                static::BUTTON_LABEL,
                $this->formClass::stepRoute($this->stepKey),
                $this->formClass::previous('step', $this->stepKey),
                'POST',
                static::BLADE,
            )->render()
            : GovukPage::questions(
                static::TITLE,
                $question,
                static::BUTTON_LABEL,
                $this->formClass::stepRoute($this->stepKey),
                $this->formClass::previous('step', $this->stepKey),
                'POST',
                static::BLADE,
            )->render();
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
