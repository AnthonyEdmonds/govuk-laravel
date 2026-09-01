<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Facades\Route;
use NunoMaduro\LaravelMojito\ViewAssertion;

class LanguagesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Route::get('/languages')->name('languages');
    }

    public function test(): void
    {
        $languages = $this->makeComponent()
            ->first('ul');

        $languages->first('li > span')
            ->hasAttribute('lang', 'en')
            ->contains('English');

        $languages->first('li > a')
            ->hasAttribute('href', route('languages', 'cy'))
            ->hasAttribute('lang', 'cy')
            ->hasAttribute('hreflang', 'cy')
            ->contains('Cymraeg');
    }


    protected function makeComponent(): ViewAssertion
    {
        return $this->assertView('govuk::components.languages', [
            'current' => 'en',
            'languages' => [
                'en' => 'English',
                'cy' => 'Cymraeg',
            ],
            'route' => 'languages',
        ]);
    }
}
