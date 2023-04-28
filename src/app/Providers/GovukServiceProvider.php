<?php

namespace AnthonyEdmonds\GovukLaravel\Providers;

use AnthonyEdmonds\GovukLaravel\Controllers\FormController;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\AfterDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\BeforeDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\OnDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\OnOrAfterDate;
use AnthonyEdmonds\GovukLaravel\Rules\Dates\OnOrBeforeDate;
use AnthonyEdmonds\GovukLaravel\Rules\Times\AfterTime;
use AnthonyEdmonds\GovukLaravel\Rules\Times\AtOrAfterTime;
use AnthonyEdmonds\GovukLaravel\Rules\Times\AtOrBeforeTime;
use AnthonyEdmonds\GovukLaravel\Rules\Times\AtTime;
use AnthonyEdmonds\GovukLaravel\Rules\Times\TimeFormat;
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
            __DIR__.'/../../resources/views/layout/header.blade.php' => resource_path('views/vendor/govuk/layout/header.blade.php'),
            __DIR__.'/../../resources/views/layout/footer.blade.php' => resource_path('views/vendor/govuk/layout/footer.blade.php'),
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
        Route::macro('govukLaravelForms', function () {
            Route::prefix('/forms/{formKey}')
                ->name('forms.')
                ->controller(FormController::class)
                ->group(function () {
                    Route::get('/start', 'start')->name('start');
                    Route::post('/start', 'create');

                    Route::get('/{subjectKey}/edit', 'edit')->name('edit');

                    Route::get('/{mode}/summary', 'summary')->name('summary');
                    Route::post('/{mode}/summary', 'submit');

                    Route::get('/{mode}/confirmation/{subjectKey?}', 'confirmation')->name('confirmation');

                    Route::get('/{mode}/{questionKey}', 'question')->name('question');
                    Route::post('/{mode}/{questionKey}', 'store');
                    Route::post('/{mode}/{questionKey}/skip', 'skip')->name('skip');
                });
        });
    }

    protected function bootRules(): void
    {
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

        // Times
        Rule::macro('afterTime', function (Carbon $time) {
            return new AfterTime($time);
        });

        Rule::macro('atOrAfterTime', function (Carbon $time) {
            return new AtOrAfterTime($time);
        });

        Rule::macro('atOrBeforeTime', function (Carbon $time) {
            return new AtOrBeforeTime($time);
        });

        Rule::macro('AtTime', function (Carbon $time) {
            return new AtTime($time);
        });

        Rule::macro('BeforeTime', function (Carbon $time) {
            return new BeforeDate($time);
        });

        Rule::macro('timeFormat', function () {
            return new TimeFormat();
        });

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
    }

    protected function bootViews(): void
    {
        $this->loadViewsFrom(
            __DIR__.'/../../resources/views',
            'govuk'
        );
    }
}
