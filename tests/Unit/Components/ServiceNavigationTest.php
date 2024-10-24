<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\Models\User;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use NunoMaduro\LaravelMojito\ViewAssertion;

class ServiceNavigationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Gate::define('manage_users', function () {
            return true;
        });

        Route::get('/home')->name('home');
        Route::get('/sign-in')->name('sign-in');
        Route::get('/sign-out')->name('sign-out');
        Route::get('/somewhere')->name('somewhere-else');
        Route::get('/users')->name('users.index');
    }

    public function testHidesAriaLabelWhenNoServiceName(): void
    {
        $this->expectEmptyNodeList();

        $this->makeComponent()
            ->first('section[aria-label]');
    }

    public function testHidesSpanWhenNoServiceName(): void
    {
        $this->expectEmptyNodeList();

        $this->makeComponent()
            ->first('section > div > div > span');
    }

    public function testHasLinkedServiceName(): void
    {
        $this->makeComponent([
            'service_name' => 'My service',
            'service_route' => 'home',
        ])
            ->hasAttribute('aria-label', 'My service')
            ->first('section > div > div > span > a')
            ->hasAttribute('href', route('home'))
            ->contains('My service');
    }

    public function testHasUnlinkedServiceName(): void
    {
        $this->makeComponent([
            'service_name' => 'My service',
        ])
            ->hasAttribute('aria-label', 'My service')
            ->first('section > div > div > span > strong')
            ->contains('My service');
    }

    public function testHasLinks(): void
    {
        $this->actingAs(new User());

        $navigation = $this->makeComponent([
            'current_section' => 'users',
            'links' => [
                'Other link' => 'somewhere-else',
                'Manage users' => [
                    'blank' => true,
                    'can' => 'manage_users',
                    'route' => 'users.index',
                ],
            ],
        ])->first('ul');

        $navigation
            ->first('li:nth-child(1) a')
            ->contains('Other link')
            ->hasAttribute('href', route('somewhere-else'))
            ->hasAttribute('target', '_self');

        $navigation
            ->first('li:nth-child(2) a')
            ->hasAttribute('aria-current', 'true')
            ->hasAttribute('href', route('users.index'))
            ->hasAttribute('target', '_blank')
            ->first('a > strong')
            ->contains('Manage users');
    }

    public function testShowsAuthTrueWhenSignedIn(): void
    {
        $this->actingAs(new User());

        $navigation = $this->makeComponent([
            'links' => [
                'Sign out' => [
                    'auth' => true,
                    'route' => 'sign-out',
                ],
            ],
        ])->first('ul');

        $navigation
            ->first('li > a')
            ->contains('Sign out')
            ->hasAttribute('href', route('sign-out'))
            ->hasAttribute('target', '_self');
    }

    public function testShowsAuthFalseWhenNotSignedIn(): void
    {
        $navigation = $this->makeComponent([
            'links' => [
                'Sign in' => [
                    'auth' => false,
                    'route' => 'sign-in',
                ],
            ],
        ])->first('ul');

        $navigation
            ->first('li > a')
            ->contains('Sign in')
            ->hasAttribute('href', route('sign-in'))
            ->hasAttribute('target', '_self');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewAttributes();

        return $this->assertView('govuk::components.service-navigation', [
            'currentSection' => $data['current_section'] ?? null,
            'links' => $data['links'] ?? [],
            'serviceName' => $data['service_name'] ?? null,
            'serviceRoute' => $data['service_route'] ?? null,
        ]);
    }
}
