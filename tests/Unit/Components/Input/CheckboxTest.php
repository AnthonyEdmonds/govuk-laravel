<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\Input;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class CheckboxTest extends TestCase
{
    public function testShowsDivider(): void
    {
        $this->makeComponent([
            'option' => [
                'divider' => true,
                'label' => 'My label',
            ],
        ])
            ->first('div')
            ->hasClass('govuk-checkboxes__divider')
            ->contains('My label');
    }

    public function testHasId(): void
    {
        $checkbox = $this->makeComponent();

        $checkbox->first('div > input')
            ->hasAttribute('id', 'my-id');

        $checkbox->first('div > label')
            ->hasAttribute('for', 'my-id');
    }

    public function testHasName(): void
    {
        $checkbox = $this->makeComponent();

        $checkbox->first('div > input')
            ->hasAttribute('name', 'my-name');
    }

    public function testHasValue(): void
    {
        $this->makeComponent()
            ->first('div > input')
            ->hasAttribute('value', 'my-value');
    }

    public function testCheckedWhenSelected(): void
    {
        $this->makeComponent([
            'selections' => [
                'my-value',
            ],
        ])
            ->first('div > input')
            ->hasAttribute('checked', 'checked');
    }

    public function testIsExclusive(): void
    {
        $this->makeComponent([
            'option' => [
                'label' => 'My label',
                'exclusive' => true,
            ],
        ])
            ->first('div > input')
            ->hasAttribute('data-behaviour', 'exclusive');
    }

    public function testHasLabel(): void
    {
        $this->makeComponent()
            ->first('div > label')
            ->contains('My label');
    }

    public function testHasHint(): void
    {
        $this->makeComponent([
            'option' => [
                'label' => 'My label',
                'hint' => 'My hint',
            ],
        ])
            ->first('div > div')
            ->hasAttribute('id', 'my-id-hint')
            ->contains('My hint');
    }

    public function testHasInputs(): void
    {
        $checkbox = $this->makeComponent([
            'option' => [
                'label' => 'My label',
                'inputs' => [
                    ['label' => 'Input label', 'name' => 'input-name'],
                ],
            ],
        ]);

        $checkbox
            ->first('div > input')
            ->hasAttribute('data-aria-controls', 'conditional-my-name');

        $input = $checkbox->at('div', 1)
            ->hasAttribute('id', 'conditional-my-name');

        $input->first('div > label')
            ->contains('Input label');

        $input->first('div > input')
            ->hasAttribute('name', 'input-name');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewErrors();

        return $this->assertView('govuk::components.input.checkbox', [
            'id' => $data['id'] ?? 'my-id',
            'name' => $data['name'] ?? 'my-name',
            'option' => $data['option'] ?? 'My label',
            'selections' => $data['selections'] ?? [],
            'value' => $data['value'] ?? 'my-value',
        ]);
    }
}
