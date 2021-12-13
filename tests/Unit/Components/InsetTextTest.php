<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Testing\TestView;

class InsetTextTest extends TestCase
{
    public function testRendersComponent(): void
    {
        $this->makeInsetText()
            ->assertSee('govuk-inset-text');
    }

    public function testHasContent(): void
    {
        $this->makeInsetText()
            ->assertSee('My inset text');
    }

    protected function makeInsetText(): TestView
    {
        return $this->blade('
            <x-govuk::inset-text>
                My inset text
            </x-govuk::inset-text>
        ');
    }
}
