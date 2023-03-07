<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class FormGroupTest extends TestCase
{
    public function testMakesFormGroup(): void
    {
        $this->setViewErrors();

        $this->makeComponent()
            ->first('div')
            ->hasClass('govuk-form-group')
            ->contains('My content');
    }

    public function testFormatsWithErrors(): void
    {
        $this->setViewErrors(['my-name' => 'My error']);

        $this->makeComponent()
            ->first('div')
            ->hasClass('govuk-form-group--error');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        return $this->assertView('govuk::components.form-group', [
            'name' => $data['my-name'] ?? 'my-name',
        ]);
    }
}

