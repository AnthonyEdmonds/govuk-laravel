<?php

namespace AnthonyEdmonds\GovukLaravel\Providers;

use AnthonyEdmonds\GovukLaravel\Forms\FormController;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\AfterDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\BeforeDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\OnDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\OnOrAfterDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\OnOrBeforeDate;
use AnthonyEdmonds\GovukLaravel\Rules\Words\MaxWords;
use AnthonyEdmonds\GovukLaravel\Rules\Words\MinWords;
use AnthonyEdmonds\GovukLaravel\Rules\Words\WordsBetween;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rule;

class GovukServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/govuk.php',
            'govuk'
        );
    }

    public function boot(): void
    {
        $this->bootPublishes();
        $this->bootRoutes();
        $this->bootRules();
        $this->bootViews();
    }

    protected function bootPublishes(): void
    {
        $this->publishes([
            __DIR__.'/../../config/govuk.php' => config_path('govuk.php'),
            __DIR__.'/../../resources/scss/govuk-variables.scss' => resource_path('scss/govuk-variables.scss'),
            __DIR__.'/../../resources/views/errors' => resource_path('views/errors'),
            __DIR__.'/../../resources/views/layout' => resource_path('views/vendor/govuk/layout'),
        ], 'govuk-core');

        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/govuk'),
        ], 'govuk-blade');

        $this->publishes([
            __DIR__.'/../../resources/scss/inter.scss' => resource_path('scss/inter.scss'),
            __DIR__.'/../../resources/fonts/inter' => resource_path('fonts/inter'),
        ], 'govuk-fonts');
    }

    protected function bootRoutes(): void
    {
        if (Route::hasMacro('govukForm') === false) {
            Route::macro('govukForm', function (string $formClass) {
                Route::controller(FormController::class)
                    ->prefix('/'.$formClass::KEY)
                    ->name($formClass::KEY.'.')
                    ->group(function () use ($formClass) {
                        Route::get('/start', 'start')
                            ->name('start')
                            ->defaults('formClass', $formClass);

                        Route::get('/summary', 'summary')
                            ->name('summary')
                            ->defaults('formClass', $formClass);

                        Route::post('/submit', 'submit')
                            ->name('submit')
                            ->defaults('formClass', $formClass);

                        Route::get('/confirmation', 'confirmation')
                            ->name('confirmation')
                            ->defaults('formClass', $formClass);

                        Route::get('/exit', 'exit')
                            ->name('exit')
                            ->defaults('formClass', $formClass);

                        // TODO Steps with only edit, and no create? Can there be a single method for both?

                        Route::prefix('/{stepKey}')
                            ->group(function () use ($formClass) {
                                Route::get('/', 'step')
                                    ->name('step')
                                    ->defaults('formClass', $formClass);

                                Route::post('/', 'save')
                                    ->name('step')
                                    ->defaults('formClass', $formClass);
                            });
                    });
            });
        }
    }

    protected function bootRules(): void
    {
        /* Does not work in the way I want it to. How to pass min and max, and get the message to the validator?
        Validator::extend('max_words', function ($attribute, $value, $parameters, $validator) {
            $rule = new MaxWords($parameters[0]);
            return $rule->passes($attribute, $value);
        });

        Validator::extend('min_words', function ($attribute, $value, $parameters, $validator) {
            $rule = new MinWords($parameters[0]);
            return $rule->passes($attribute, $value);
        });

        Validator::extend('words_between', function ($attribute, $value, $parameters, $validator) {
            $rule = new WordsBetween($parameters[0], $parameters[1]);
            return $rule->passes($attribute, $value);
        });
        */

        // Words
        Rule::macro('maxWords', function (int $max) {
            return new MaxWords($max);
        });

        Rule::macro('minWords', function (int $min) {
            return new MinWords($min);
        });

        Rule::macro('wordsBetween', function (int $min, int $max) {
            return new WordsBetween($min, $max);
        });

        // Dates
        Rule::macro('onDate', function (Carbon $date) {
            return new OnDate($date);
        });

        Rule::macro('afterDate', function (Carbon $date) {
            return new AfterDate($date);
        });

        Rule::macro('beforeDate', function (Carbon $date) {
            return new BeforeDate($date);
        });

        Rule::macro('onOrAfterDate', function (Carbon $date) {
            return new OnOrAfterDate($date);
        });

        Rule::macro('onOrBeforeDate', function (Carbon $date) {
            return new OnOrBeforeDate($date);
        });
    }

    protected function bootViews(): void
    {
        $this->loadViewsFrom(
            __DIR__.'/../../resources/views',
            'govuk'
        );
    }
}
