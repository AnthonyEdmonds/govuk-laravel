<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class PasswordTest extends TestCase
{
    public function testHasHint(): void
    {
        $group = $this->makeComponent([
            'hint' => 'My hint',
        ]);

        $group->first('div.govuk-hint')
            ->hasAttribute('id', 'my-id-hint')
            ->contains('My hint');

        $group->first('input')
            ->hasAttribute('aria-describedby', 'my-id-hint');
    }

    public function testHasId(): void
    {
        $group = $this->makeComponent();

        $group->first('label')
            ->hasAttribute('for', 'my-id');

        $group->first('input')
            ->hasAttribute('id', 'my-id');

        $group->first('button')
            ->hasAttribute('aria-controls', 'my-id');
    }

    public function testHasInputmode(): void
    {
        $this->makeComponent()
            ->first('input')
            ->hasAttribute('inputmode', 'text');
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
            ->first('input')
            ->hasAttribute('name', 'my-name');
    }

    public function testHasIsTitle(): void
    {
        $this->makeComponent([
            'isTitle' => true,
        ])
            ->has('div > h1');
    }

    public function testHasValue(): void
    {
        $this->makeComponent()
            ->first('input')
            ->hasAttribute('value', 'my-value');
    }

    public function testHasWidth(): void
    {
        $this->makeComponent([
            'width' => 10,
        ])
            ->first('input')
            ->hasClass('govuk-input--width-10');
    }

    public function testHasOld(): void
    {
        $this->setRequestOld([
            'my-name' => 'Old value',
        ]);

        $this->makeComponent()
            ->first('input')
            ->hasAttribute('value', 'Old value');
    }

    public function testHasErrors(): void
    {
        $group = $this->makeComponent([], [
            'my-name' => 'An error',
        ]);

        $group->first('p.govuk-error-message')
            ->contains('An error');

        $group->first('input')
            ->hasClass('govuk-input--error')
            ->hasAttribute('aria-describedby', ' my-id-error');
    }

    public function testHasNew(): void
    {
        $this->makeComponent([
            'new' => true,
        ])
            ->first('input')
            ->hasAttribute('autocomplete', 'new-password');

        $this->makeComponent([
            'new' => false,
        ])
            ->first('input')
            ->hasAttribute('autocomplete', 'current-password');
    }

    protected function makeComponent(array $data = [], array $errors = []): ViewAssertion
    {
        $this->setViewErrors($errors);

        return $this->assertView('govuk::components.password', [
            'hint' => $data['hint'] ?? null,
            'id' => $data['id'] ?? 'my-id',
            'inputmode' => $data['inputmode'] ?? 'text',
            'label' => $data['label'] ?? 'My label',
            'labelSize' => $data['labelSize'] ?? 's',
            'name' => $data['name'] ?? 'my-name',
            'new' => $data['new'] ?? false,
            'isTitle' => $data['isTitle'] ?? false,
            'value' => $data['value'] ?? 'my-value',
            'width' => $data['width'] ?? null,
        ]);
    }
}
