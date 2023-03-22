<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class FieldsetTest extends TestCase
{
    public function testMakesFieldset(): void
    {
        $this->makeComponent()
            ->first('fieldset')
            ->hasAttribute('aria-describedby', 'my-id-hint')
            ->contains('My content')
            ->first('legend')
            ->hasClass('govuk-fieldset__legend--l')
            ->contains('My label');
    }

    public function testMakesAsTitle(): void
    {
        $this->makeComponent([
            'isTitle' => true,
        ])
            ->first('fieldset > legend > h1')
            ->contains('My label');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        return $this->assertView('govuk::components.fieldset', [
            'id' => $data['id'] ?? 'my-id',
            'isTitle' => $data['isTitle'] ?? false,
            'label' => $data['label'] ?? 'My label',
            'labelSize' => $data['labelSize'] ?? 'l',
        ]);
    }
}
