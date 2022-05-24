<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Questions\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class FormQuestion extends FormStep
{
    abstract public function question(Model|array $data): array|Question;

    abstract public function save(Request $request, Model|array $data): void;

    abstract public function rules(): array;

    abstract public function messages(): array;

    // Form Step
    public function page(): View
    {
        $question = $this->question();

        return $question instanceof Question === true
            ? GovukPage::question(
                $question,
                static::BUTTON_LABEL,
                $this->formClass::stepRoute($this->stepKey),
                $this->formClass::previous('step', $this->stepKey),
                'POST',
                static::BLADE,
            )
            : GovukPage::questions(
                static::TITLE,
                $question,
                static::BUTTON_LABEL,
                $this->formClass::stepRoute($this->stepKey),
                $this->formClass::previous('step', $this->stepKey),
                'POST',
                static::BLADE,
            );
    }

    public function nextRoute(): string
    {
        // TODO: Implement nextRoute() method.
    }

    public function backRoute(): string
    {
        // TODO: Implement backRoute() method.
    }
}
