<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class PanelTest extends TestCase
{
    public function testConfirmation(): void
    {
        $panel = $this->makePanel(false)
            ->hasClass('govuk-panel')
            ->hasClass('govuk-panel--confirmation');

        $panel->first('h1')
            ->contains('Application complete');

        $panel->first('div')
            ->contains('Your reference number')
            ->has('strong')
            ->contains('HDJ2123F');

        $buttons = $panel->first('div.govuk-button-group');

        $buttons->first('a')
            ->hasAttribute('href', 'Confirm-url')
            ->contains('Confirm label');

        $buttons->last('a')
            ->hasAttribute('href', 'Cancel-url')
            ->contains('Cancel label');
    }

    public function testInterruption(): void
    {
        $this->makePanel(true)
            ->hasClass('govuk-panel')
            ->hasClass('govuk-panel--interruption');
    }

    protected function makePanel(bool $interruption): ViewAssertion
    {
        $this->setViewAttributes();

        $this->setViewSlot(
            'slot',
            'Your reference number
            <br/><strong>HDJ2123F</strong>',
        );

        return $this->assertView('govuk::components.panel', [
            'interruption' => $interruption,
            'title' => 'Application complete',
            'confirmLabel' => 'Confirm label',
            'confirmUrl' => 'Confirm-url',
            'cancelLabel' => 'Cancel label',
            'cancelUrl' => 'Cancel-url',
        ]);
    }
}
