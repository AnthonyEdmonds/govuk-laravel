<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Testing\TestView;
use NunoMaduro\LaravelMojito\ViewAssertion;

class InsetTextTest extends TestCase
{
    public function testRendersComponent(): void
    {
        $this->makeInsetText()
            ->first('div')
            ->hasClass('govuk-inset-text');
    }

    public function testHasContent(): void
    {
        $this->makeInsetText()
            ->first('div')
            ->contains('My inset text');
    }

    protected function makeInsetText(): ViewAssertion
    {
        $this->setViewSlot('My inset text');

        return $this->assertView('govuk::components.inset-text');
    }
}
