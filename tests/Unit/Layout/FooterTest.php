<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Layout;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Facades\Route;
use NunoMaduro\LaravelMojito\ViewAssertion;

class FooterTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Route::get('/home')->name('home');
        Route::get('/feedback')->name('feedback');

        config()->set('govuk.feedback.route', 'feedback');
    }

    public function test(): void
    {
        $this->make()
            ->has('div.govuk-feedback')
            ->contains('Built by the')
            ->contains('All content is')
            ->contains('Crown copyright');
    }

    protected function make(): ViewAssertion
    {
        $this->setViewAttributes();

        return $this->assertView('govuk::layout.footer');
    }
}
