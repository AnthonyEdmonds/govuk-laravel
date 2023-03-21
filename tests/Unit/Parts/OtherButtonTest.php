<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Parts;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class OtherButtonTest extends TestCase
{
    public function testNothingWhenHrefNull(): void
    {
        $this->expectEmptyNodeList();
        
        $this->makeComponent();
    }
    
    public function testLinkWhenGetMethod(): void
    {
        $this->makeComponent([
            'otherButtonHref' => 'other-action',
            'otherButtonLabel' => 'Other label',
        ])
            ->hasAttribute('href', 'other-action')
            ->contains('Other label');
    }

    public function testButtonWhenPostMethod(): void
    {
        $this->makeComponent([
            'otherButtonHref' => 'other-action',
            'otherButtonLabel' => 'Other label',
            'otherButtonMethod' => 'POST',
        ])
            ->hasAttribute('formaction', 'other-action')
            ->hasAttribute('formmethod', 'POST')
            ->contains('Other label');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        return $this->assertView('govuk::parts.other-button', [
            'otherButtonHref' => $data['otherButtonHref'] ?? null,
            'otherButtonLabel' => $data['otherButtonLabel'] ?? null,
            'otherButtonMethod' => $data['otherButtonMethod'] ?? null,
        ]);
    }
}
