<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class PTest extends TestCase
{
    public function testHasContent(): void
    {
        $this->makeComponent()
            ->first('p')
            ->hasClass('govuk-body')
            ->contains('My content');
    }

    public function testHasBold(): void
    {
        $this->makeComponent([
            'bold' => true,
        ])
            ->first('p')
            ->hasClass('govuk-\!-font-weight-bold');
    }

    public function testHasLead(): void
    {
        $this->makeComponent([
            'lead' => true,
        ])
            ->first('p')
            ->hasClass('govuk-body-l');
    }

    public function testHasSmall(): void
    {
        $this->makeComponent([
            'small' => true,
        ])
            ->first('p')
            ->hasClass('govuk-body-s');
    }
    
    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');
        
        return $this->assertView('govuk::components.p', [
            'bold' => $data['bold'] ?? false,
            'lead' => $data['lead'] ?? false,
            'small' => $data['small'] ?? false,
        ]);
    }
}
