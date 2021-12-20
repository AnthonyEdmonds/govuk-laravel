<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class TabsTest extends TestCase
{
    public function testHasTitle(): void
    {
        $this->makeTabs()
            ->first('h2')
            ->contains('My tabs');
    }

    public function testHasTabs(): void
    {
        $tabList = $this->makeTabs()
            ->first('ul');

        $tabList->first('li a')
            ->hasAttribute('href', '#tab-one')
            ->contains('Tab one label');

        $tabList->last('li a')
            ->hasAttribute('href', '#tab-two')
            ->contains('Tab two label');
    }

    public function testRemovesPlaceholders(): void
    {
        $this->makeTabs()
            ->first('div .govuk-tabs__panel')
            ->empty();
    }

    public function testRendersTabPanelSlot(): void
    {
        $this->makeTabs()
            ->last('div .govuk-tabs__panel h2')
            ->contains('Tab two title');
    }

    protected function makeTabs(): ViewAssertion
    {
        $this->setViewAttributes();
        $this->setViewSlot(
            'slot',
            '<x-govuk::tab-panel
                id="tab-one"
                label="Tab one label"
            ></x-govuk::tab-panel>
            
            <x-govuk::tab-panel
                id="tab-two"
                label="Tab two label"
            >
                <x-govuk::h2>Tab two title</x-govuk::h2>
            </x-govuk::tab-panel>'
        );

        return $this->assertView('govuk::components.tabs', [
            'title' => 'My tabs'
        ]);
    }
}
