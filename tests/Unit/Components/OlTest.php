<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class OlTest extends TestCase
{
    public function testHasBullets(): void
    {
        $this->makeComponent()
            ->first('ol > li')
            ->contains('My item');
    }

    public function testHasSpacedClass(): void
    {
        $this->makeComponent([
            'spaced' => true,
        ])
            ->first('ol')
            ->hasClass('govuk-list--spaced');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', '<li>My item</li>');

        return $this->assertView('govuk::components.ol', [
            'spaced' => $data['spaced'] ?? false,
        ]);
    }
}
