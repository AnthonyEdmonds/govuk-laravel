<?php

namespace AnthonyEdmonds\GovukLaravel\Providers;

use AnthonyEdmonds\GovukLaravel\Rules\MaxWords;
use AnthonyEdmonds\GovukLaravel\Rules\MinWords;
use AnthonyEdmonds\GovukLaravel\Rules\WordsBetween;
use Illuminate\Support\Facades\Validator;
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
        $this->bootRules();
        $this->bootViews();
    }

    protected function bootPublishes(): void
    {
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/govuk'),
        ], 'govuk-blade');

        $this->publishes([
            __DIR__.'/../../config/govuk.php' => config_path('govuk.php'),
        ], 'govuk-config');

        $this->publishes([
            __DIR__.'/../../resources/views/errors' => resource_path('views/errors'),
        ], 'govuk-errors');
    }

    protected function bootRules(): void
    {
        Validator::extend('max_words', MaxWords::class);
        Validator::extend('min_words', MinWords::class);
        Validator::extend('words_between', WordsBetween::class);

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
