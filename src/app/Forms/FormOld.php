<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

abstract class FormOld
{
    public static function getNextRoute(): string
    {
        $currentPage = static::getCurrentPageName();

        if (static::isCurrentlyOpen() === false) {
            return static::HAS_START_PAGE === true
                ? self::getStartRoute()
                : self::getFirstStep()::route(static::class);
        }

        if ($currentPage === 'start') {
            return self::getFirstStep()::route(static::class);
        }

        if ($currentPage === 'summary') {
            return static::getSubmitRoute();
        }

        if ($currentPage === 'submit') {
            return static::HAS_CONFIRMATION_PAGE === true
                ? static::getConfirmationRoute()
                : static::getExitRoute();
        }

        if ($currentPage === 'confirmation') {
            return static::getExitRoute();
        }

        $currentStep = static::getCurrentStepKey();
        $currentSection = static::findSectionClassByStep($currentStep);

        if ($currentSection::isLastStep($currentStep) === true) {
            // TODO If editing, go to summary

            if (static::isLastSection($currentSection) === true) {
                return static::HAS_SUMMARY_PAGE === true
                    ? static::getSummaryRoute()
                    : static::getSubmitRoute();
            }

            // Next section, first step
        }

        return $currentSection::nextStep($currentStep);
    }
}
