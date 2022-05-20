<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use AnthonyEdmonds\GovukLaravel\Exceptions\FormSectionNotFound;
use AnthonyEdmonds\GovukLaravel\Exceptions\FormStepNotFound;
use Illuminate\Support\Facades\Route;

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

    public static function getPreviousRoute(): string
    {
        // TODO
    }

    // Sections
    public static function getSection(string $sectionKey): string
    {
        $sectionClass = static::findSectionClass($sectionKey);

        if ($sectionClass === false) {
            throw new FormSectionNotFound(static::KEY, $sectionKey);
        }

        return $sectionClass;
    }

    public static function getFirstSection(): string
    {
        return static::SECTIONS[0];
    }

    public static function getNextSection(string $sectionKey): string
    {
        return static::findSectionIndex($sectionKey) + 1;
    }

    public static function isLastSection(string $sectionKey): bool
    {
        $count = count(static::SECTIONS) - 1;
        return (static::SECTIONS[$count])::KEY === $sectionKey;
    }

    // Steps
    public static function getStep(string $stepKey): FormStepOld
    {
        $stepClass = static::findStepClass($stepKey);

        if ($stepClass === false) {
            throw new FormStepNotFound(static::KEY, $stepKey);
        }

        return new $stepClass(static::class);

        // Change to class name to be consistent, different method name?
    }

    public static function getFirstStep(): string
    {
        return static::getFirstSection()::getFirstStep();
    }

    // Location
    public static function getCurrentPageName(): string
    {
        $routeName = Route::currentRouteName();

        return substr(
            $routeName,
            strrpos($routeName, '.')
        );
    }

    public static function getCurrentStepKey(): string|false
    {
        return Route::current()->parameter('stepKey', false);
    }

    public static function isCurrentlyOpen(): bool
    {
        return str_contains(
            Route::currentRouteName(),
            static::BASE_ROUTE
        );
    }

    // Utilities
    protected static function findSectionClass(string $sectionKey): string|false
    {
        foreach (static::SECTIONS as $section) {
            if ($section::KEY === $sectionKey) {
                return $section;
            }
        }

        return false;
    }

    protected static function findSectionIndex(string $sectionKey): int|false
    {
        foreach (static::SECTIONS as $index => $section) {
            if ($section::KEY === $sectionKey) {
                return $index;
            }
        }

        return false;
    }

    protected static function findSectionClassByStep(string $stepKey): string|false
    {
        foreach (static::SECTIONS as $section) {
            if ($section::hasStepClassByKey($stepKey) === true) {
                return $section;
            }
        }

        return false;
    }

    protected static function findStepClass(string $stepKey): string|false
    {
        foreach (static::SECTIONS as $section) {
            if ($section::hasStepClassByKey($stepKey) === true) {
                return $section::getStepClassByKey($stepKey);
            }
        }

        return false;
    }

    protected static function getRoute(string $name): string
    {
        return route(static::BASE_ROUTE . ".$name");
    }
}
