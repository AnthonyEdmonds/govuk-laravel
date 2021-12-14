<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class SkipLinkTest extends TestCase
{
    public function testHasAnchor(): void
    {
        $this->makeSkipLink()
            ->first('a')
            ->hasAttribute('href', '#my-anchor');
    }

    public function testHasLabel(): void
    {
        $this->makeSkipLink()
            ->first('a')
            ->contains('My label');
    }

    protected function makeSkipLink(): ViewAssertion
    {
        $this->setViewAttributes();

        return $this->assertView('govuk::components.skip-link', [
            'anchor' => 'my-anchor',
            'label' => 'My label'
        ]);
    }
}
