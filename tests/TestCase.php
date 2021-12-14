<?php

namespace AnthonyEdmonds\GovukLaravel\Tests;

use AnthonyEdmonds\GovukLaravel\Providers\GovukServiceProvider;
use AnthonyEdmonds\GovukLaravel\Tests\Traits\SetsViewVariables;
use Illuminate\Foundation\Testing\WithFaker;
use NunoMaduro\LaravelMojito\InteractsWithViews;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use InteractsWithViews;
    use SetsViewVariables;
    use WithFaker;
    
    protected function getPackageProviders($app): array
    {
        return [
            GovukServiceProvider::class,
        ];
    }
}
