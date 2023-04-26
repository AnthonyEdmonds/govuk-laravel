<?php

namespace AnthonyEdmonds\GovukLaravel\Tests;

use AnthonyEdmonds\GovukLaravel\Providers\GovukServiceProvider;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestFormAlt;
use AnthonyEdmonds\GovukLaravel\Tests\Models\User;
use AnthonyEdmonds\GovukLaravel\Tests\Traits\AssertsValidationRules;
use AnthonyEdmonds\GovukLaravel\Tests\Traits\FakesRoute;
use AnthonyEdmonds\GovukLaravel\Tests\Traits\SetsViewVariables;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use InvalidArgumentException;
use NunoMaduro\LaravelMojito\InteractsWithViews;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use InteractsWithViews;
    use SetsViewVariables;
    use WithFaker;
    use FakesRoute;
    use AssertsValidationRules;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMix();
    }

    protected function signIn(User $user): User
    {
        Auth::login($user);

        return $user;
    }

    protected function getPackageProviders($app): array
    {
        return [
            GovukServiceProvider::class,
        ];
    }

    protected function useForms(): void
    {
        Config::set('govuk.forms', [
            TestForm::class,
            TestFormAlt::class,
        ]);

        $router = app('router');
        $router->get('/')->name('/');
        $router->govukLaravelForms();
    }

    protected function useDatabase(): void
    {
        $this->app->useDatabasePath(__DIR__.'/Database');
        $this->runLaravelMigrations();
    }

    protected function expectEmptyNodeList(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The current node list is empty.');
    }
}
