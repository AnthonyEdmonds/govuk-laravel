<?php

namespace AnthonyEdmonds\GovukLaravel\Tests;

use AnthonyEdmonds\GovukLaravel\Providers\GovukServiceProvider;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use InteractsWithViews;
    use WithFaker;
    
    protected function getPackageProviders($app): array
    {
        return [
            GovukServiceProvider::class,
        ];
    }
}
