<?php

namespace AnthonyEdmonds\GovukLaravel\Providers;

use Illuminate\Support\ServiceProvider;

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
        $this->loadViewsFrom(
            __DIR__.'/../../resources/views', 'govuk'
        );
        
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
}
