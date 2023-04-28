<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class CaptionTest extends TestCase
{
    public function testHasContent(): void
    {
        $this->makeComponent()
            ->first('span')
            ->contains('My content');
    }

    public function testHasSize(): void
    {
        $this->makeComponent()
            ->first('span')
            ->hasClass('govuk-caption-m');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        return $this->assertView('govuk::components.caption', [
            'size' => $data['size'] ?? 'm',
        ]);
    }
}
