<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Facades\Route;
use NunoMaduro\LaravelMojito\ViewAssertion;

class GenericHeaderTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Route::get('/home')->name('home');
    }

    public function test(): void
    {
        $this->makeHeader()
            ->first('div > div > div > a')
            ->hasAttribute('href', route('home'))
            ->first('a')
            ->contains('My label')
            ->first('img')
            ->hasAttribute('alt', 'My logo alt')
            ->hasAttribute('src', 'logo.jpg')
            ->hasAttribute('height', '44');
    }

    protected function makeHeader(): ViewAssertion
    {
        $this->setViewAttributes();

        return $this->assertView('govuk::components.generic-header', [
            'label' => 'My label',
            'logoAlt' => 'My logo alt',
            'logoHeight' => 44,
            'logoImage' => 'logo.jpg',
            'logoRoute' => 'home',
        ]);
    }
}
