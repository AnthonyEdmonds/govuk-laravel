<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukUrl;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukUrl;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Facades\Route;

class ResolvePathFromConfigTest extends TestCase
{
    public function testUrl(): void
    {
        config()->set('govuk.mail.header.logo', 'http://my.logo/logo.png');

        $this->assertEquals(
            'http://my.logo/logo.png',
            GovukUrl::resolvePathFromConfig('govuk.mail.header.logo'),
        );
    }

    public function testAsset(): void
    {
        config()->set('govuk.mail.header.logo', 'logos/my-logo.png');

        $this->assertEquals(
            asset('logos/my-logo.png'),
            GovukUrl::resolvePathFromConfig('govuk.mail.header.logo'),
        );
    }

    public function testRoute(): void
    {
        Route::get('/logo/header')->name('logos.header');

        config()->set('govuk.mail.header.logo', 'logos.header');

        $this->assertEquals(
            route('logos.header'),
            GovukUrl::resolvePathFromConfig('govuk.mail.header.logo'),
        );
    }
}
