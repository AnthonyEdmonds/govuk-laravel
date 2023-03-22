<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class SelectTest extends TestCase
{
    public function testHasAutocomplete(): void
    {
        $this->makeComponent()
            ->first('select')
            ->hasAttribute('autocomplete', 'on');
    }

    public function testHasHint(): void
    {
        $group = $this->makeComponent([
            'hint' => 'My hint',
        ]);

        $group->first('div > div')
            ->hasAttribute('id', 'my-id-hint')
            ->contains('My hint');

        $group->first('select')
            ->hasAttribute('aria-describedby', 'my-id-hint');
    }

    public function testHasId(): void
    {
        $group = $this->makeComponent();

        $group->first('label')
            ->hasAttribute('for', 'my-id');

        $group->first('select')
            ->hasAttribute('id', 'my-id');
    }

    public function testHasLabel(): void
    {
        $this->makeComponent()
            ->first('label')
            ->contains('My label');
    }

    public function testHasLabelSize(): void
    {
        $this->makeComponent()
            ->first('label')
            ->hasClass('govuk-label--s');
    }

    public function testHasName(): void
    {
        $this->makeComponent()
            ->first('div > select')
            ->hasAttribute('name', 'my-name');
    }

    public function testHasOptions(): void
    {
        $options = $this->makeComponent([
            'options' => [
                'option-one' => 'Label one',
                'option-two' => 'Label two',
            ],
            'value' => 'option-one',
        ])
            ->first('select');

        $options->at('option', 1)
            ->hasAttribute('selected', 'selected')
            ->hasAttribute('value', 'option-one')
            ->contains('Label one');

        $options->at('option', 2)
            ->hasAttribute('value', 'option-two')
            ->contains('Label two');
    }

    public function testIsTitle(): void
    {
        $this->makeComponent([
            'isTitle' => true,
        ])
            ->first('div')
            ->has('h1');
    }

    public function testHasError(): void
    {
        $this->makeComponent([], [
            'my-name' => 'Big error',
        ])
            ->first('select')
            ->hasClass('govuk-select--error')
            ->hasAttribute('aria-describedby', ' my-id-error');
    }

    protected function makeComponent(array $data = [], array $errors = []): ViewAssertion
    {
        $this->setViewErrors($errors);

        return $this->assertView('govuk::components.select', [
            'autocomplete' => $data['autocomplete'] ?? 'on',
            'hint' => $data['hint'] ?? null,
            'id' => $data['id'] ?? 'my-id',
            'label' => $data['label'] ?? 'My label',
            'labelSize' => $data['labelSize'] ?? 's',
            'name' => $data['name'] ?? 'my-name',
            'options' => $data['options'] ?? [],
            'isTitle' => $data['isTitle'] ?? false,
            'value' => $data['value'] ?? null,
        ]);
    }
}
