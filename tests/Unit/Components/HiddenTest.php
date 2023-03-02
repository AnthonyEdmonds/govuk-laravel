<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class HiddenTest extends TestCase
{
    public function testRendersContent(): void
    {
        $this->makeComponent()
            ->first('span')
            ->hasClass('govuk-visually-hidden')
            ->contains('My content');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        return $this->assertView('govuk::components.hidden');
    }
}
