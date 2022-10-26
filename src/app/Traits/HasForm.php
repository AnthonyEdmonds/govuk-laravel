<?php

namespace AnthonyEdmonds\GovukLaravel\Traits;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Forms\Question as FormQuestion;
use AnthonyEdmonds\GovukLaravel\Questions\Question as GovukQuestion;

trait HasForm
{
    public Form $form;

    abstract public static function formClass(): string;

    public function __construct()
    {
        parent::__construct();

        $formClass = static::formClass();
        $this->form = new $formClass();
    }

    public static function startFormRoute(): string
    {
        return route('forms.start', static::formClass()::key());
    }

    public function toSummary(): array
    {
        $summary = [];
        $questionClasses = $this->form->questions();

        foreach ($questionClasses as $questionClass) {
            $formQuestion = new $questionClass();
            $question = $formQuestion->getQuestion($this);

            $this->questionToSummaryEntry($summary, $formQuestion);
        }

        return $summary;
    }

    protected function questionToSummaryEntry(array &$summary, FormQuestion $formQuestion): void
    {
        $govukQuestion = $formQuestion->getQuestion($this);

        if (is_array($govukQuestion) === true) {
            foreach ($govukQuestion as $subGovukQuestion) {
                $this->summaryEntry($summary, $formQuestion, $subGovukQuestion);
            }
        } else {
            $this->summaryEntry($summary, $formQuestion, $govukQuestion);
        }
    }

    protected function summaryEntry(array &$summary, FormQuestion $formQuestion, GovukQuestion $govukQuestion): void
    {
        $label = ucfirst(str_replace('_', ' ', $govukQuestion->name));
        $property = $govukQuestion->name;

        $summary[$label] = [
            'value' => $this->$property,
            'action' => [
                'label' => 'Change',
                'hidden' => $label,
                'url' => route('forms.question', [
                    $this->form::key(),
                    $this->exists === true
                        ? Form::EDIT
                        : Form::REVIEW,
                    $formQuestion::key(),
                ]),
            ],
        ];
    }
}
