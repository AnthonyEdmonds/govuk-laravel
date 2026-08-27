<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Templates;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Facades\Route;
use NunoMaduro\LaravelMojito\ViewAssertion;

class InterruptionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Route::get('/')->name('home');
    }

    public function test(): void
    {
        $this->makePage()
            ->first('.govuk-panel')
            ->hasClass('govuk-panel--interruption')
            ->contains('Interruption title');
    }

    protected function makePage(): ViewAssertion
    {
        return $this->assertView('govuk::templates.interruption', [
            'confirmLabel' => 'Confirm label',
            'confirmUrl' => 'Confirm url',
            'cancelLabel' => 'Cancel label',
            'cancelUrl' => 'Cancel url',
            'title' => 'Interruption title',
        ]);
    }
}
