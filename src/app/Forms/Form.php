<?php

namespace AnthonyEdmonds\GovukLaravel\Forms;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;

// TODO We really need to figure out the model pass-in now.
// Data could be loaded / saved using helper, or abstract function
// Could also be left up to the user to define in the Submit / Edit methods...
// Form step takes model / array, and returns model / array for storing...

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

    abstract public static function exit(): RedirectResponse;

    abstract public static function submit(): RedirectResponse;

    public static function next(string $page, string $stepKey = null): RedirectResponse
    {
        if ($page === 'confirmation') {
            // TODO Exit controller method?
                
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
            // TODO Exit

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

        return redirect($route);
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
        // TODO Pass in model / information / data
        
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
    
    public static function submitRoute(): string
    {
        return static::routeFor('submit');
    }

    public static function summaryRoute(): string
    {
        return static::routeFor('summary');
    }

    protected static function routeFor(string $suffix, array $attributes = []): string
    {
        // TODO return route name instead?
        
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
    
    public static function isAtEndOfSection(string $stepKey): bool
    {
        
    }

    public static function isAtStartOfSection(string $stepKey): bool
    {

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
