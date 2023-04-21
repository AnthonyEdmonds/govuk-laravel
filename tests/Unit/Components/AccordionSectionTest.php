<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

// TODO Find a way to test @aware properties
class AccordionSectionTest extends TestCase
{
    public function testHasIdAndSubId(): void
    {
        $section = $this->makeComponent([
            'summary' => 'My summary',
        ]);
        
        $section->first('div > div > h2 > span')
            ->hasAttribute('id', 'accordion--heading-my-sub-id');
        
        $section->first('div > div > div')
            ->hasAttribute('id', 'accordion--summary-my-sub-id');
        
        $section->last('div > div')
            ->hasAttribute('aria-labelledby', 'accordion--heading-my-sub-id');
    }

    public function testHasLabel(): void
    {
        $this->makeComponent()
            ->first('div > div > h2 > span')
            ->contains('My label');
    }
    
    public function testHasSummary(): void
    {
        $this->makeComponent([
            'summary' => 'My summary'
        ])
            ->first('div > div > div')
            ->contains('My summary');
    }

    public function testHasSlotContent(): void
    {
        $this->makeComponent()
            ->last('div > div')
            ->contains('My content');
    }
    
    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        return $this->assertView('govuk::components.accordion-section', [
            'id' => '',
            'label' => $data['label'] ?? 'My label',
            'subid' => $data['subid'] ?? 'my-sub-id',
            'summary' => $data['summary'] ?? null,
        ]);
    }
}
