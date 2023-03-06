<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class H1Test extends TestCase
{
    public function testHasContent(): void
    {
        $this->makeComponent()
            ->first('h1')
            ->contains('My content');
    }

    public function testHasSize(): void
    {
        $this->makeComponent([
            'size' => 'l',
        ])
            ->first('h1')
            ->hasClass('govuk-heading-l');
    }

    public function testHasIdWhenSet(): void
    {
        $this->makeComponent([
            'id' => 'my-id',
        ])
            ->first('h1')
            ->hasAttribute('id', 'my-id');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        return $this->assertView('govuk::components.h1', [
            'id' => $data['id'] ?? null,
            'size' => $data['size'] ?? 'm',
        ]);
    }
}
