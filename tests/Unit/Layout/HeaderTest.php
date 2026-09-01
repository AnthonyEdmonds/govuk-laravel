<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Layout;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Facades\Route;
use NunoMaduro\LaravelMojito\ViewAssertion;

class HeaderTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Route::get('/home')->name('home');
        Route::get('/languages')->name('languages');

        config()->set('govuk.languages.route', 'languages');
    }

    public function test(): void
    {
        $this->makeHeader()
            ->has('div')
            ->first('section.govuk-service-navigation')
            ->has('nav.govuk-language-navigation');
    }

    public function testLogoAsset(): void
    {
        $this->makeHeader([
            'asset' => 'images/asset.jpg',
        ])
            ->first('div > div > div > a > img')
            ->hasAttribute('src', 'http://localhost/images/asset.jpg');
    }

    public function testLogoLiteral(): void
    {
        $this->makeHeader([
            'asset' => 'https://my-site.com/images/asset.jpg',
        ])
            ->first('div > div > div > a > img')
            ->hasAttribute('src', 'https://my-site.com/images/asset.jpg');
    }

    public function testLogoRoute(): void
    {
        $this->makeHeader([
            'asset' => 'home',
        ])
            ->first('div > div > div > a > img')
            ->hasAttribute('src', 'http://localhost/home');
    }

    protected function makeHeader(array $data = []): ViewAssertion
    {
        $this->setViewAttributes();

        config()->set(
            'govuk.header.logo.asset',
            $data['asset'] ?? 'images/asset.jpg',
        );

        return $this->assertView('govuk::layout.header', [
            'currentSection' => $data['currentSection'] ?? null,
        ]);
    }
}
