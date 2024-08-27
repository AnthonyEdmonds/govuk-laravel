<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\Models\User;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use NunoMaduro\LaravelMojito\ViewAssertion;

class HeaderTest extends TestCase
{
    public function testHasLinks(): void
    {
        $this->actingAs(new User);
        $navigation = $this->makeHeader()->first('ul');

        $navigation
            ->first('li:nth-child(1) a')
            ->contains('Other link')
            ->hasAttribute('href', route('somewhere-else'))
            ->hasAttribute('target', '_self');

        $navigation
            ->first('li:nth-child(2) a')
            ->contains('Manage users')
            ->hasAttribute('href', route('users.index'))
            ->hasAttribute('target', '_blank');
    }

    public function testHasLogo(): void
    {
        $this->makeHeader()
            ->first('div > div > a > img')
            ->hasAttribute('alt', 'My logo alt')
            ->hasAttribute('src', 'logo.jpg')
            ->hasAttribute('height', '44');
    }

    public function testHasLogoRoute(): void
    {
        $this->makeHeader()
            ->first('.govuk-header__link--homepage')
            ->hasAttribute('href', route('home'));
    }

    public function testHasServiceName(): void
    {
        $this->makeHeader()
            ->first('.govuk-header__service-name')
            ->contains('My service name');
    }

    public function testServiceNameHasRoute(): void
    {
        $this->makeHeader()
            ->first('.govuk-header__service-name')
            ->hasAttribute('href', route('home'));
    }

    public function testShowsAuthTrueWhenSignedIn(): void
    {
        $this->actingAs(new User);
        $navigation = $this->makeHeader()->first('ul');

        $navigation
            ->first('li:nth-child(3) a')
            ->contains('Sign out')
            ->hasAttribute('href', route('sign-out'))
            ->hasAttribute('target', '_self');
    }

    public function testShowsAuthFalseWhenNotSignedIn(): void
    {
        $navigation = $this->makeHeader()->first('ul');

        $navigation
            ->first('li:nth-child(2) a')
            ->contains('Sign in')
            ->hasAttribute('href', route('sign-in'))
            ->hasAttribute('target', '_self');
    }

    protected function makeHeader(): ViewAssertion
    {
        $this->setViewAttributes();

        Gate::define('manage_users', function () {
            return true;
        });
        Route::get('/home')->name('home');
        Route::get('/sign-in')->name('sign-in');
        Route::get('/sign-out')->name('sign-out');
        Route::get('/somewhere')->name('somewhere-else');
        Route::get('/users')->name('users.index');

        return $this->assertView('govuk::components.header', [
            'links' => [
                'Other link' => route('somewhere-else'),
                'Manage users' => [
                    'blank' => true,
                    'can' => 'manage_users',
                    'link' => route('users.index'),
                ],
                'Sign in' => [
                    'auth' => false,
                    'link' => route('sign-in'),
                ],
                'Sign out' => [
                    'auth' => true,
                    'link' => route('sign-out'),
                ],
            ],
            'logoAlt' => 'My logo alt',
            'logoHeight' => 44,
            'logoImage' => 'logo.jpg',
            'logoLink' => route('home'),
            'serviceName' => 'My service name',
        ]);
    }
}
