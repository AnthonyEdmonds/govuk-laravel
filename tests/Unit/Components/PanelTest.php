<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class PanelTest extends TestCase
{
    public function test(): void
    {
        $panel = $this->makePanel()
            ->hasClass('govuk-panel')
            ->hasClass('govuk-panel--confirmation');

        $panel->first('h1')
            ->contains('Application complete');

        $panel->first('div')
            ->contains('Your reference number')
            ->has('strong')
            ->contains('HDJ2123F');
    }

    protected function makePanel(): ViewAssertion
    {
        $this->setViewAttributes();
        $this->setViewSlot(
            'slot',
            'Your reference number
            <br/><strong>HDJ2123F</strong>',
        );

        return $this->assertView('govuk::components.panel', [
            'title' => 'Application complete',
        ]);
    }
}
