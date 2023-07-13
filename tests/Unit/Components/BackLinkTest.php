<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class BackLinkTest extends TestCase
{
    public function testHasLink(): void
    {
        $this->makeComponent()
            ->first('a')
            ->hasClass('govuk-back-link')
            ->hasAttribute('href', 'my-link')
            ->contains('Back');
    }

    public function testHasInvertedClass(): void
    {
        $this->makeComponent([
            'inverted' => true,
        ])
            ->hasClass('govuk-back-link--inverse');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        return $this->assertView('govuk::components.back-link', [
            'href' => $data['href'] ?? 'my-link',
            'inverted' => $data['inverted'] ?? false,
        ]);
    }
}
