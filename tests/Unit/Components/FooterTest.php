<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\Models\User;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use NunoMaduro\LaravelMojito\ViewAssertion;

class FooterTest extends TestCase
{
    public function testHasLicenceLogo(): void
    {
        $this->setViewSlot('licence', '');

        $this->makeFooter()
            ->first('.govuk-footer__licence-logo')
            ->hasAttribute('src', asset('licence-logo.jpg'));
    }

    public function testHasLicenceLogoHeight(): void
    {
        $this->setViewSlot('licence', '');

        $this->makeFooter()
            ->first('.govuk-footer__licence-logo')
            ->hasAttribute('height', '21');
    }

    public function testHasLicenceLogoWidth(): void
    {
        $this->setViewSlot('licence', '');

        $this->makeFooter()
            ->first('.govuk-footer__licence-logo')
            ->hasAttribute('width', '44');
    }

    public function testHasMetaHeading(): void
    {
        $this->makeFooter()
            ->first('.govuk-footer__meta-item h2')
            ->contains('My meta heading');
    }

    public function testHasFirstMetaLinks(): void
    {
        $this->makeFooter()
            ->first('.govuk-footer__inline-list')
            ->first('li a')
            ->contains('Manage users')
            ->hasAttribute('href', route('users.index'))
            ->hasAttribute('target', '_blank');
    }

    public function testHasSecondMetaLinks(): void
    {
        $this->makeFooter()
            ->first('.govuk-footer__inline-list')
            ->last('li a')
            ->contains('Sign out')
            ->hasAttribute('href', route('sign-out'))
            ->hasAttribute('target', '_self');
    }

    public function testHasFirstNavigationLink(): void
    {
        $navigation = $this->makeFooter()->first('.govuk-footer__navigation');

        $first = $navigation->first('.govuk-footer__section');
        $first->hasClass('govuk-grid-column-one-quarter');
        $first->first('h2')->contains('Management');

        $links = $first->first('ul');
        $links->hasClass('govuk-footer__list--columns-0');

        $links
            ->first('li a')
            ->contains('Manage users')
            ->hasAttribute('href', route('users.index'))
            ->hasAttribute('target', '_self');

    }

    public function testHasSecondNavigationLink(): void
    {
        $navigation = $this->makeFooter()->first('.govuk-footer__navigation');

        $first = $navigation->first('.govuk-footer__section:nth-of-type(2)');
        $first->hasClass('govuk-grid-column-one-quarter');
        $first->first('h2')->contains('Departments and policy');

        $links = $first->first('ul');
        $links->hasClass('govuk-footer__list--columns-0');

        $links
            ->first('li a')
            ->contains('Departments')
            ->hasAttribute('href', route('departments.index'))
            ->hasAttribute('target', '_blank');

        $links
            ->last('li a')
            ->contains('Policies')
            ->hasAttribute('href', route('policies.index'))
            ->hasAttribute('target', '_self');
    }

    public function testHasThirdNavigationLink(): void
    {
        $navigation = $this->makeFooter()->first('.govuk-footer__navigation');

        $first = $navigation->last('.govuk-footer__section');
        $first->hasClass('govuk-grid-column-two-quarters');
        $first->first('h2')->contains('Services and information');

        $links = $first->first('ul');
        $links->hasClass('govuk-footer__list--columns-2');

        $links
            ->first('li a')
            ->contains('Benefits')
            ->hasAttribute('href', route('benefits.index'))
            ->hasAttribute('target', '_blank');

        $links
            ->last('li a')
            ->contains('Information')
            ->hasAttribute('href', route('information.index'))
            ->hasAttribute('target', '_self');
    }

    public function testRendersInformationSlot(): void
    {
        $this->setViewSlot(
            'information',
            '<p>My information</p>'
        );

        $this->makeFooter()
            ->first('.govuk-footer__meta-custom p')
            ->contains('My information');
    }

    public function testRendersLicenceSlot(): void
    {
        $this->setViewSlot(
            'licence',
            '<p>My licence</p>'
        );

        $this->makeFooter()
            ->first('.govuk-footer__licence-description p')
            ->contains('My licence');
    }

    public function testRendersLogosSlot(): void
    {
        $this->setViewSlot(
            'logos',
            '<p>My logos</p>'
        );

        $this->makeFooter()
            ->first('.govuk-footer__meta-item p')
            ->contains('My logos');
    }

    public function testShowsAuthTrueWhenSignedIn(): void
    {
        $footer = $this->makeFooter();

        $metaLinks = $footer->first('.govuk-footer__meta ul');
        $navLinks = $footer->first('.govuk-footer__navigation ul');

        $metaLinks
            ->last('li a')
            ->hasAttribute('href', route('sign-out'));

        $navLinks
            ->last('li a')
            ->hasAttribute('href', route('users.index'));
    }

    public function testShowsAuthFalseWhenNotSignedIn(): void
    {
        $footer = $this->makeFooter(false);

        $metaLinks = $footer->first('.govuk-footer__meta ul');
        $navLinks = $footer->first('.govuk-footer__navigation ul');

        $metaLinks->empty();

        $navLinks
            ->last('li a')
            ->hasAttribute('href', route('sign-in'));
    }

    protected function makeFooter(bool $signIn = true): ViewAssertion
    {
        $this->setViewAttributes();

        if ($signIn === true) {
            $this->actingAs(new User());
        }

        Gate::define('manage_users', function () {
            return true;
        });
        Gate::define('view_departments', function () {
            return true;
        });
        Gate::define('view_benefits', function () {
            return true;
        });
        Route::get('/sign-in')->name('sign-in');
        Route::get('/sign-out')->name('sign-out');
        Route::get('/users')->name('users.index');
        Route::get('/departments')->name('departments.index');
        Route::get('/policies')->name('policies.index');
        Route::get('/benefits')->name('benefits.index');
        Route::get('/information')->name('information.index');

        return $this->assertView('govuk::components.footer', [
            'licenceLogo' => asset('licence-logo.jpg'),
            'licenceLogoHeight' => 21,
            'licenceLogoWidth' => 44,
            'metaHeading' => 'My meta heading',
            'metaLinks' => [
                'Manage users' => [
                    'blank' => true,
                    'can' => 'manage_users',
                    'link' => route('users.index'),
                ],
                'Sign out' => [
                    'auth' => true,
                    'link' => route('sign-out'),
                ],
            ],
            'navigationLinks' => [
                'Management' => [
                    'Manage users' => route('users.index'),
                    'Sign in' => [
                        'auth' => false,
                        'link' => route('sign-in'),
                    ],
                ],
                'Departments and policy' => [
                    'Departments' => [
                        'blank' => true,
                        'can' => 'view_departments',
                        'link' => route('departments.index'),
                    ],
                    'Policies' => route('policies.index'),
                ],
                'Services and information' => [
                    'columns' => 2,
                    'links' => [
                        'Benefits' => [
                            'blank' => true,
                            'can' => 'view_benefits',
                            'link' => route('benefits.index'),
                        ],
                        'Information' => route('information.index'),
                    ],
                ],
            ],
        ]);
    }
}
