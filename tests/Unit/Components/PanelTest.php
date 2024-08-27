<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class PanelTest extends TestCase
{
    public function testHasColour(): void
    {
        $this->makePanel()
            ->first('div')
            ->hasAttribute(
                'class',
                'govuk-panel govuk-panel--confirmation app-!-background-dark-blue',
            );
    }

    public function testHasTitle(): void
    {
        $this->makePanel()
            ->first('h1')
            ->contains('Application complete');
    }

    public function testRendersSlot(): void
    {
        $this->makePanel()
            ->first('div div')
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
            'colour' => 'dark-blue',
            'title' => 'Application complete',
        ]);
    }
}
