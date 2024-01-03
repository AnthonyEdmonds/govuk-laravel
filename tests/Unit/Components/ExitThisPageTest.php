<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class ExitThisPageTest extends TestCase
{
    public function testHasExitButton(): void
    {
        $this->makeComponent()
            ->first('div')
            ->hasClass('govuk-exit-this-page')
            ->first('a')
            ->hasAttribute('href', 'my-link')
            ->hasAttribute('rel', 'nofollow noreferrer')
            ->contains('My label');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        return $this->assertView('govuk::components.exit-this-page', [
            'href' => $data['href'] ?? 'my-link',
            'label' => $data['label'] ?? 'My label',
        ]);
    }
}
