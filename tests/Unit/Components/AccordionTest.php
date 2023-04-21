<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class AccordionTest extends TestCase
{
    public function testHasId(): void
    {
        $this->makeComponent()
            ->first('div')
            ->hasAttribute('id', 'accordion-my-id');
    }

    public function testRemembersExpanded(): void
    {
        $this->makeComponent([
            'rememberExpanded' => true,
        ])
            ->hasAttribute('data-remember-expanded', 'true');

        $this->makeComponent()
            ->hasAttribute('data-remember-expanded', 'false');
    }

    public function testHasSlotContent(): void
    {
        $this->makeComponent()
            ->contains('My content');
    }
    
    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        return $this->assertView('govuk::components.accordion', [
            'id' => $data['id'] ?? 'my-id',
            'rememberExpanded' => $data['rememberExpanded'] ?? false,
        ]);
    }
}
