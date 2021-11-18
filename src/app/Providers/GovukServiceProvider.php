<?php

namespace AnthonyEdmonds\GovukLaravel\Providers;

use Illuminate\Support\ServiceProvider;

class GovukServiceProvider extends ServiceProvider
{
    // TODO loadRoutesFrom?
    // TODO Publish assets, such as fonts and logo placeholders
    
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
        
        /*$this->loadViewComponentsAs('govuk', [
            TODO
        ]);*/

        /* TODO Publish fonts, placeholder images, JS, CSS
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/govuk'),
        ], 'govuk-assets');
        */

        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/govuk'),
        ], 'govuk-blade');
        
        $this->publishes([
            __DIR__.'/../../config/govuk.php' => config_path('govuk.php'),
        ], 'govuk-config');
    }
}
