<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use AnthonyEdmonds\GovukLaravel\Exceptions\FormStepNotFound;
use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

abstract class Form
{
    const STEPS = [];

    const KEY = 'my-form';
    const TITLE = 'My Form';

    const BASE_ROUTE_NAME = 'my-form';
    const EXIT_ROUTE_NAME = 'home';

    const HAS_START_PAGE = true;
    const START_BLADE_NAME = 'my-form.start';
    const START_BUTTON_LABEL = 'Start';

    const HAS_SUMMARY_PAGE = true;
    const SUMMARY_BLADE_NAME = 'my-form.summary';

    const HAS_CONFIRMATION_PAGE = true;
    const CONFIRMATION_PAGE_NAME = 'my-form.confirmation';

    // Abstracts
    abstract public static function authorize(?Model $user, string $ability): bool;

    abstract public static function exit(): RedirectResponse;

    abstract public static function submit(): RedirectResponse;

    // Pages
    public static function confirmation(): View
    {
        return GovukPage::confirmation();
    }

    public static function start(): View
    {
        return GovukPage::start(
            static::TITLE,
            static::firstStep()->route(),
            static::START_BUTTON_LABEL,
            static::START_BLADE_NAME
        );
    }

    public static function step(string $stepKey): FormStep
    {
        $stepClass = static::findStepByKey($stepKey);
        return new $stepClass(static::class);
    }

    public static function summary(): View
    {
        return GovukPage::summary();
    }

    // Actions
    public static function next(string $stepKey): RedirectResponse
    {

    }

    public static function previous(string $stepKey): RedirectResponse
    {

    }

    // Utilities
    public static function findStepByKey(string $needle, ?bool $direction = null): array|false
    {
        $previousStep = false;
        $steps = [];
        $takeNext = false;

        foreach (static::STEPS as $key => $step) {
            if (is_array($step) === true) {
                foreach ($step as $sectionKey => $sectionStep) {
                    $steps[$sectionKey] = $sectionStep;
                }
            } else {
                $steps[$key] = $step;
            }
        }

        foreach ($steps as $key => $step) {
            if ($takeNext === true) {
                return [$key => $step];
            }

            if ($key === $needle) {
                if ($direction === true) {
                    $takeNext = true;

                } elseif ($direction === false) {
                    return $previousStep;

                } else {
                    return [$key => $step];
                }
            }

            if ($direction === false) {
                $previousStep = [$key => $step];
            }
        }

        return false;
    }

    public static function getFirstStep(): FormStep
    {
        $firstKey = array_key_first(static::STEPS);

        if (is_array(static::STEPS[$firstKey]) === true) {
            $firstSectionKey = array_key_first(static::STEPS[$firstKey]);
            $firstStep = static::STEPS[$firstKey][$firstSectionKey];

        } else {
            $firstStep = static::STEPS[$firstKey];
        }

        return static::getStep($firstStep::KEY);
    }

    public static function getStepKeyAfter(string $stepKey): string
    {
        return array_key_first(
            static::findStepByKey($stepKey, true)
        );
    }

    public static function getStepKeyBefore(string $stepKey): string
    {
        return array_key_first(
            static::findStepByKey($stepKey, false)
        );
    }
}
