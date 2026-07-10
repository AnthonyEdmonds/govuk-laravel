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
    }

    public function test(): void
    {
        $this->makeHeader()
            ->has('header')
            ->has('nav');
    }

    public function testLogoAsset(): void
    {
        $this->makeHeader([
            'asset' => 'images/asset.jpg',
        ])
            ->first('header > div > div > a > img')
            ->hasAttribute('src', 'http://localhost/images/asset.jpg');
    }

    public function testLogoLiteral(): void
    {
        $this->makeHeader([
            'asset' => 'https://my-site.com/images/asset.jpg',
        ])
            ->first('header > div > div > a > img')
            ->hasAttribute('src', 'https://my-site.com/images/asset.jpg');
    }

    public function testLogoRoute(): void
    {
        $this->makeHeader([
            'asset' => 'home',
        ])
            ->first('header > div > div > a > img')
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
