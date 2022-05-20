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
    
    public const START_BLADE_NAME = 'my-form.start';
    public const START_BUTTON_LABEL = 'Start';
    public const SUMMARY_BLADE_NAME = 'my-form.summary';
    public const CONFIRMATION_PAGE_NAME = 'my-form.confirmation';

    // Actions
    abstract public static function authorize(?Model $user, string $ability): bool;

    abstract public static function clear(): void;

    abstract public static function load(): Model|array;

    abstract public static function save(Model|array $data): void;

    abstract public static function submit(): RedirectResponse;

    public static function next(string $page, string $stepKey = null): RedirectResponse
    {
        if ($page === 'confirmation') {
            $route = static::exitRoute();
                
        } elseif ($page === 'submit') {
            $route = static::confirmationRoute();
                
        } elseif ($page === 'summary') {
            $route = static::submitRoute();
            
        } elseif ($page === 'start') {
            $route = static::stepRoute(static::getFirstStepKey());
            
        } elseif ($page === 'step' && $stepKey !== null) {
            if (static::isAtEndOfSection($stepKey) === true) {
                // TODO Detect editing, model exists? But that would not work with drafts where the model is saved...
            } elseif (static::isLastStep($stepKey) === true) {
                $route = static::summaryRoute();
            } else {
                $route = static::stepRoute(static::getStepKeyAfter($stepKey));
            }
        } else {
            $route = static::startRoute();
        }
        
        return redirect($route);
    }

    public static function previous(string $page, string $stepKey = null): RedirectResponse
    {
        if ($page === 'confirmation') {
            // TODO Can't really go back from here... exit?

        } elseif ($page === 'submit') {
            $route = static::summaryRoute();

        } elseif ($page === 'summary') {
            $route = static::stepRoute(static::getLastStepKey());

        } elseif ($page === 'start') {
            $route = static::exitRoute();

        } elseif ($page === 'step' && $stepKey !== null) {
            if (static::isAtStartOfSection($stepKey) === true) {
                // TODO Detect editing, model exists? But that would not work with drafts where the model is saved...
            } elseif (static::isFirstStep($stepKey) === true) {
                $route = static::startRoute();
            } else {
                $route = static::stepRoute(static::getStepKeyBefore($stepKey));
            }
        } else {
            $route = static::startRoute();
        }

        return redirect()->route($route);
    }

    // Pages
    public static function confirmation(): View
    {
        return GovukPage::confirmation();
    }

    public static function exit(): RedirectResponse
    {
        return redirect()->route(static::exitRoute());
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
        return new $stepClass(static::class, $stepKey, static::load());
    }

    public static function summary(): View
    {
        return GovukPage::summary();
    }

    // Routes
    public static function confirmationRoute(): string
    {
        return static::routeNameFor('confirmation');
    }

    public static function exitRoute(): string
    {
        return static::routeNameFor('exit');
    }

    public static function startRoute(): string
    {
        return static::routeNameFor('start');
    }

    public static function stepRoute(string $stepKey): string
    {
        return static::routeNameFor('step', [$stepKey]);
    }
    
    public static function submitRoute(): string
    {
        return static::routeNameFor('submit');
    }

    public static function summaryRoute(): string
    {
        return static::routeNameFor('summary');
    }

    protected static function routeNameFor(string $suffix): string
    {
        return static::BASE_ROUTE_NAME !== null
            ? static::BASE_ROUTE_NAME . '.' . static::KEY . '.' . $suffix
            : static::KEY . '.' . $suffix;
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
    
    public static function isAtEndOfSection(string $stepKey): bool
    {
        $previousKey = null;

        foreach (static::STEPS as $key => $step) {
            if (is_array($step) === true) {
                if ($previousKey === $stepKey) {
                    return true;
                }

                if (array_key_last($step) === $stepKey) {
                    return true;
                }
            }

            $previousKey = $key;
        }

        return $previousKey === $stepKey;
    }

    public static function isAtStartOfSection(string $stepKey): bool
    {
        $inSection = false;

        foreach (static::STEPS as $key => $step) {
            if (is_array($step) === true) {
                if (array_key_first($step) === $stepKey) {
                    return true;
                }

                $inSection = false;

            } else {
                if ($inSection === false) {
                    if ($key === $stepKey) {
                        return true;
                    }

                    $inSection = true;
                }
            }
        }

        return false;
    }

    public static function isFirstStep(string $stepKey): bool
    {
        return static::getStepKeyBefore($stepKey) === false;
    }
    
    public static function isLastStep(string $stepKey): bool
    {
        return static::getStepKeyAfter($stepKey) === false;
    }
}
