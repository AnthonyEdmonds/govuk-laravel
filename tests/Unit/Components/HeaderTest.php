<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

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
            ->first('header > div > div > a')
            ->hasAttribute('href', route('home'))
            ->first('a > img')
            ->hasAttribute('alt', 'My logo alt')
            ->hasAttribute('src', 'logo.jpg')
            ->hasAttribute('height', '44');
    }

    protected function makeHeader(): ViewAssertion
    {
        $this->setViewAttributes();

        return $this->assertView('govuk::components.header', [
            'logoAlt' => 'My logo alt',
            'logoHeight' => 44,
            'logoImage' => 'logo.jpg',
            'logoRoute' => 'home',
        ]);
    }
}
