<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use AnthonyEdmonds\GovukLaravel\Exceptions\FormStepNotFound;

abstract class FormSection
{
    const KEY = 'form-section';
    const STEPS = [];

    protected Form $form;

    // Construction
    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    // Steps
    public function getStep(int $index): FormStep
    {
        return static::STEPS[$index];
    }

    public function getStepByKey(string $stepKey): FormStep
    {
        foreach (static::STEPS as $step) {
            if ($step::KEY === $stepKey) {
                return $step;
            }
        }

        throw new FormStepNotFound($this->form, $this, $stepKey);
    }
}
