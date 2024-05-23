<?php

namespace AnthonyEdmonds\GovukLaravel\Traits;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Forms\Question as FormQuestion;

trait HasForm
{
    public string $blankFieldTerm = 'Not given';
    
    // Summary
    public function toSummary(bool $showChange = false): array
    {
        return $this->generateSummary($showChange);
    }

    protected function generateSummary(bool $showChange = false): array
    {
        $summary = [];
        $questionClasses = $this->form()->questions();

        foreach ($questionClasses as $questionClass) {
            $formQuestion = new $questionClass();

            $this->questionToSummaryEntry($summary, $formQuestion, $showChange);
        }

        return $summary;
    }

    protected function questionToSummaryEntry(array &$summary, FormQuestion $formQuestion, bool $showChange): void
    {
        $govukQuestion = $formQuestion->getQuestion($this);

        if (is_array($govukQuestion) === true) {
            foreach ($govukQuestion as $subGovukQuestion) {
                $this->summaryEntry($summary, $formQuestion, $subGovukQuestion, $showChange);
            }
        } else {
            $this->summaryEntry($summary, $formQuestion, $govukQuestion, $showChange);
        }
    }

    protected function summaryEntry(array &$summary, FormQuestion $formQuestion, GovukQuestion $govukQuestion, bool $showChange): void
    {
        $label = ucfirst(str_replace('_', ' ', $govukQuestion->name));
        $property = $govukQuestion->name;

        $summary[$label] = $this->makeSummaryItem(
            $formQuestion::key(),
            $label,
            $this->$property,
            $showChange,
        );
    }

    protected function makeSummaryItem(
        string $questionKey,
        string $label,
        mixed $value = null,
        bool $showChange = false
    ): array {
        if (
            is_array($value) === true
            || is_string($value) === true
        ) {
            $value = empty($value) === false ? $value : null;
        }

        return [
            'value' => $value ?? $this->blankFieldTerm,
            'action' => $showChange === true
                ? [
                    'label' => 'Change',
                    'hidden' => $label,
                    'url' => route('forms.question', [
                        $this->form()::key(),
                        $this->exists === true
                            ? Form::EDIT
                            : Form::REVIEW,
                        $questionKey,
                    ]),
                ]
                : null,
        ];
    }
}
