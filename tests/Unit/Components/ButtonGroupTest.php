<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class ButtonGroupTest extends TestCase
{
    public function testCreatesGroup(): void
    {
        $this->makeComponent()
            ->first('div')
            ->hasClass('govuk-button-group')
            ->contains('My content');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        return $this->assertView('govuk::components.button-group');
    }
}

