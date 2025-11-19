<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class UlTest extends TestCase
{
    public function testHasBullets(): void
    {
        $this->makeComponent()
            ->first('ul > li')
            ->contains('My item');
    }

    public function testHasBulletedClass(): void
    {
        $this->makeComponent([
            'bulleted' => true,
        ])
            ->first('ul')
            ->hasClass('govuk-list--bullet');
    }

    public function testHasSpacedClass(): void
    {
        $this->makeComponent([
            'spaced' => true,
        ])
            ->first('ul')
            ->hasClass('govuk-list--spaced');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', '<li>My item</li>');

        return $this->assertView('govuk::components.ul', [
            'bulleted' => $data['bulleted'] ?? false,
            'spaced' => $data['spaced'] ?? false,
            'type' => $data['type'] ?? 'bullet',
        ]);
    }
}
