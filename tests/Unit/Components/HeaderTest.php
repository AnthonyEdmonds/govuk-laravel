<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\Models\User;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use NunoMaduro\LaravelMojito\ViewAssertion;

class HeaderTest extends TestCase
{
    public function testHasLinks(): void
    {
        $navigation = $this->makeHeader()->first('ul');

        $navigation
            ->first('li a')
            ->contains('Manage users')
            ->hasAttribute('href', route('users.index'))
            ->hasAttribute('target', '_blank');

        $navigation
            ->last('li a')
            ->contains('Sign out')
            ->hasAttribute('href', route('sign-out'))
            ->hasAttribute('target', '_self');
    }

    public function testHasLogoAlt(): void
    {
        $this->makeHeader()
            ->first('.govuk-header__logotype img')
            ->hasAttribute('alt', 'My logo alt');
    }

    public function testHasLogoRoute(): void
    {
        $this->makeHeader()
            ->first('.govuk-header__link--homepage')
            ->hasAttribute('href', route('home'));
    }

    public function testHasLogoImage(): void
    {
        $this->makeHeader()
            ->first('.govuk-header__logotype img')
            ->hasAttribute('src', 'logo.jpg');
    }

    public function testHasLogoHeight(): void
    {
        $this->makeHeader()
            ->first('.govuk-header__logotype img')
            ->hasAttribute('height', '44');
    }

    public function testHasServiceName(): void
    {
        $this->makeHeader()
            ->first('.govuk-header__link--service-name')
            ->contains('My service name');
    }

    public function testServiceNameHasRoute(): void
    {
        $this->makeHeader()
            ->first('.govuk-header__link--service-name')
            ->hasAttribute('href', route('home'));
    }

    protected function makeHeader(): ViewAssertion
    {
        $this->setViewAttributes();
        $this->actingAs(new User());

        Gate::define('manage_users', function () {
            return true;
        });
        Route::get('/home')->name('home');
        Route::get('/sign-out')->name('sign-out');
        Route::get('/users')->name('users.index');

        return $this->assertView('govuk::components.header', [
            'links' => [
                'Manage users' => [
                    'blank' => true,
                    'can' => 'manage_users',
                    'route' => 'users.index',
                ],
                'Sign out' => 'sign-out',
            ],
            'logoAlt' => 'My logo alt',
            'logoRoute' => 'home',
            'logoImage' => 'logo.jpg',
            'logoHeight' => 44,
            'serviceName' => 'My service name',
        ]);
    }
}
