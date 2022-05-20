<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

abstract class Form
{
    public const STEPS = [];

    public const KEY = 'my-form';
    public const TITLE = 'My Form';

    public const BASE_ROUTE_NAME = null;
    public const EXIT_ROUTE_NAME = 'home';

    public const HAS_START_PAGE = true;
    public const START_BLADE_NAME = 'my-form.start';
    public const START_BUTTON_LABEL = 'Start';

    public const HAS_SUMMARY_PAGE = true;
    public const SUMMARY_BLADE_NAME = 'my-form.summary';

    public const HAS_CONFIRMATION_PAGE = true;
    public const CONFIRMATION_PAGE_NAME = 'my-form.confirmation';

    // Actions
    abstract public static function authorize(?Model $user, string $ability): bool;

    abstract public static function exit(): RedirectResponse;

    abstract public static function submit(): RedirectResponse;

    public static function next(string $stepKey): RedirectResponse
    {
    }

    public static function previous(string $stepKey): RedirectResponse
    {
    }
    
    // Pages
    public static function confirmation(): View
    {
        return GovukPage::confirmation();
    }

    public static function start(): View
    {
        return GovukPage::start(
            static::TITLE,
            static::getFirstStepClass()::route(),
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
    
    // Routes
    public static function confirmationRoute(): string
    {
        return static::routeFor('confirmation');
    }
    
    public static function startRoute(): string
    {
        return static::routeFor('start');
    }
    
    public static function stepRoute(string $stepKey): string
    {
        return static::routeFor('step', [$stepKey]);
    }

    public static function summaryRoute(): string
    {
        return static::routeFor('summary');
    }

    protected static function routeFor(string $suffix, array $attributes = []): string
    {
        $name = static::KEY . ".$suffix";

        if (static::BASE_ROUTE_NAME !== null) {
            $name = static::BASE_ROUTE_NAME . '.' . $name;
        }

        return route($name, $attributes);
    }

    // Steps
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

    public static function getFirstStepKey(): string
    {
        $firstKey = array_key_first(static::STEPS);

        return is_array(static::STEPS[$firstKey]) === true
            ? array_key_first(static::STEPS[$firstKey])
            : $firstKey;
    }

    public static function getStepKeyAfter(string $stepKey): string|false
    {
        $step = static::findStepByKey($stepKey, true);

        return $step === false
            ? false
            : array_key_first($step);
    }

    public static function getStepKeyBefore(string $stepKey): string|false
    {
        $step = static::findStepByKey($stepKey, false);

        return $step === false
            ? false
            : array_key_first($step);
    }
}
