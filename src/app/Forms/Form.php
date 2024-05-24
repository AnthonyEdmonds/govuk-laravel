<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use Illuminate\Database\Eloquent\Model;

abstract class Form
{
    // Summary
    public function summary(string $mode): Page
    {
        $subject = $this->getSubjectFromSession();
        $canEdit = $this->canEdit($subject);

        return GovukPage::summary(
            $this->summaryTitle($subject),
            $subject->toSummary($canEdit), /* @phpstan-ignore-line */
            $canEdit === true
                ? $this->summarySubmitLabel()
                : $this->summaryCancelLabel(),
            $canEdit === true
                ? $this->submitRoute($mode)
                : $this->summaryCancelRoute($subject),
            $mode === self::EDIT
                ? $this->exitRoute($subject)
                : $this->questionRoute(self::NEW, $this->getLastQuestionKey()),
            $canEdit === true
                ? Page::POST_METHOD
                : Page::GET_METHOD,
            $this->summaryBlade(),
            $canEdit === true
                ? $this->summaryCancelLabel()
                : null,
            $canEdit === true
                ? $this->summaryCancelRoute($subject)
                : null,
        )
            ->with('mode', $mode)
            ->with('subject', $subject)
            ->with('canEdit', $canEdit)
            ->with('draftButtonLabel', $canEdit === true ? $this->summaryDraftLabel() : null)
            ->with('draftButtonAction', $canEdit === true ? $this->draftRoute($mode) : null);
    }
    
    // Subject
    protected function canEdit(Model $subject): bool
    {
        return true;
    }
}
