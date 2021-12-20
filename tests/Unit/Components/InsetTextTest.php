<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class InsetTextTest extends TestCase
{
    public function testRendersSlot(): void
    {
        $this->makeInsetText()
            ->first('div')
            ->contains('My inset text');
    }

    protected function makeInsetText(): ViewAssertion
    {
        $this->setViewSlot('slot', 'My inset text');

        return $this->assertView('govuk::components.inset-text');
    }
}
