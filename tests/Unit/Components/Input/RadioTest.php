<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\Input;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class RadioTest extends TestCase
{
    public function testFormatsAsDivider(): void
    {
        $this->makeComponent([
            'option' => $this->makeOption(true),
        ])
            ->first('div')
            ->hasClass('govuk-radios__divider')
            ->contains('My option');
    }

    public function testHasRadio(): void
    {
        $radio = $this->makeComponent()
            ->first('div');

        $radio
            ->first('input')
            ->hasAttribute('id', 'my-id')
            ->hasAttribute('name', 'my-name')
            ->hasAttribute('value', 'my-value');

        $radio
            ->first('label')
            ->hasAttribute('for', 'my-id')
            ->contains('My option');
    }

    public function testSelectsRadio(): void
    {
        $this->makeComponent([
            'selected' => true,
        ])
            ->first('div > input')
            ->hasAttribute('checked', 'checked');
    }

    public function testShowsHint(): void
    {
        $this->makeComponent([
            'option' => $this->makeOption()
        ])
            ->first('div > div')
            ->hasAttribute('id', 'my-id-hint')
            ->contains('My hint');
    }

    public function testShowsInputs(): void
    {
        $radio = $this->makeComponent([
            'option' => $this->makeOption(false, true),
        ]);

        $radio
            ->first('div > input')
            ->hasAttribute('data-aria-controls', 'conditional-my-id');

        $inputs = $radio
            ->first('div.govuk-radios__conditional')
            ->hasAttribute('id', 'conditional-my-id');

        $inputs
            ->at('div > label', 0)
            ->contains('Phone number');

        $inputs
            ->at('div > label', 1)
            ->contains('Mobile number');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewErrors();

        return $this->assertView('govuk::components.input.radio', [
            'id' => $data['id'] ?? 'my-id',
            'name' => $data['name'] ?? 'my-name',
            'option' => $data['option'] ?? 'My option',
            'selected' => $data['selected'] ?? null,
            'value' => $data['value'] ?? 'my-value',
        ]);
    }

    protected function makeOption(
        bool $divider = false,
        bool $inputs = false,
    ): array {
        return [
            'divider' => $divider,
            'hint' => 'My hint',
            'label' => 'My option',
            'inputs' => $inputs === true ? [
                [
                    'label' => 'Phone number',
                    'name' => 'phone',
                ],
                [
                    'label' => 'Mobile number',
                    'name' => 'mobile',
                    'hint' => 'Without any prefixes'
                ],
            ] : null,
        ];
    }
}

