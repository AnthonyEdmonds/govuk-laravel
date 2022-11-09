<?php

namespace AnthonyEdmonds\GovukLaravel\Traits;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Forms\Question as FormQuestion;
use AnthonyEdmonds\GovukLaravel\Questions\Question as GovukQuestion;
use Illuminate\Database\Eloquent\Model;

trait HasForm
{
    public Form $form;

    abstract public static function formClass(): string;

    public function form(): Form
    {
        if (isset($this->form) === false) {
            $formClass = self::formClass();
            $this->form = new $formClass();
        }

        return $this->form;
    }

    // Routing
    public static function startFormRoute(): string
    {
        return route('forms.start', self::formClass()::key());
    }

    public static function editFormRoute(Model $subject): string
    {
        return route('forms.edit', [self::formClass()::key(), $subject->id]);
    }

    // Summary
    public function toSummary(bool $showChange = false): array
    {
        $summary = [];
        $questionClasses = $this->form()->questions();

        foreach ($questionClasses as $questionClass) {
            $formQuestion = new $questionClass();
            $question = $formQuestion->getQuestion($this);

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

        $summary[$label] = [
            'value' => $this->$property,
            'action' => $showChange === true
                ? [
                    'label' => 'Change',
                    'hidden' => $label,
                    'url' => route('forms.question', [
                        $this->form()::key(),
                        $this->exists === true
                            ? Form::EDIT
                            : Form::REVIEW,
                        $formQuestion::key(),
                    ]),
                ]
                : null,
        ];
    }
}
