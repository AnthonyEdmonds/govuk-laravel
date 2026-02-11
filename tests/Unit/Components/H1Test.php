<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class H1Test extends TestCase
{
    public function test(): void
    {
        $this->makeComponent([
            'id' => 'my-id',
            'marginBottom' => 9,
            'size' => 'l',
        ])
            ->first('h1')
            ->hasAttribute('id', 'my-id')
            ->hasClass('govuk-heading-l')
            ->hasClass('govuk-\!-margin-bottom-9')
            ->contains('My content');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        return $this->assertView('govuk::components.h1', [
            'id' => $data['id'] ?? null,
            'marginBottom' => $data['marginBottom'] ?? null,
            'size' => $data['size'] ?? 'm',
        ]);
    }
}
