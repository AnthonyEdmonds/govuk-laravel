<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class ButtonTest extends TestCase
{
    public function testFormatsAsDisabled(): void
    {
        $this->makeComponent([
            'disabled' => true,
        ])
            ->hasAttribute('aria-disabled', 'true')
            ->hasAttribute('disabled', 'disabled');
    }

    public function testPreventsDoubleClick(): void
    {
        $this->makeComponent([
            'preventDoubleClick' => true,
        ])
            ->hasAttribute('data-prevent-double-click', 'true');
    }

    public function testHasSlot(): void
    {
        $this->makeComponent()
            ->contains('My slot');
    }

    public function testFormatsAsStartButton(): void
    {
        $this->makeComponent([
            'asStartButton' => true,
        ])
            ->hasClass('govuk-button--start')
            ->has('svg');
    }

    public function testFormatsAsLink(): void
    {
        $this->makeComponent([
            'asLink' => true,
        ])
            ->hasClass('app-button--as-link');
    }

    public function testFormatsAsSecondary(): void
    {
        $this->makeComponent([
            'secondary' => true,
        ])
            ->hasClass('govuk-button--secondary');
    }

    public function testHasId(): void
    {
        $this->makeComponent([
            'id' => 'my-id',
        ])
            ->hasAttribute('id', 'my-id');
    }

    public function testHasType(): void
    {
        $this->makeComponent([
            'type' => 'submit',
        ])
            ->hasAttribute('type', 'submit');
    }

    public function testFormatsAsWarning(): void
    {
        $this->makeComponent([
            'warning' => true,
        ])
            ->hasClass('govuk-button--warning');
    }

    public function testHasFormAction(): void
    {
        $this->makeComponent([
            'formAction' => 'My action',
        ])
            ->hasAttribute('formaction', 'My action');
    }

    public function testHasFormMethod(): void
    {
        $this->makeComponent([
            'formMethod' => 'POST',
        ])
            ->hasAttribute('formmethod', 'POST');
    }

    public function testHasInverted(): void
    {
        $this->makeComponent([
            'inverted' => true,
        ])
            ->hasClass('govuk-button--inverse');
    }

    public function testHasControls(): void
    {
        $this->makeComponent([
            'controls' => 'my-control',
        ])
            ->hasAttribute('aria-controls', 'my-control');
    }

    public function testHasHidden(): void
    {
        $this->makeComponent([
            'hidden' => true,
        ])
            ->hasAttribute('hidden', '');
    }


    public function testHasLabel(): void
    {
        $this->makeComponent([
            'label' => 'My label',
        ])
            ->hasAttribute('aria-label', 'My label');
    }

    public function testHasPassword(): void
    {
        $this->makeComponent([
            'password' => true,
        ])
            ->hasClass('govuk-password-input__toggle')
            ->hasClass('govuk-js-password-input-toggle');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My slot');

        return $this->assertView('govuk::components.button', [
            'asLink' => $data['asLink'] ?? false,
            'asStartButton' => $data['asStartButton'] ?? false,
            'controls' => $data['controls'] ?? null,
            'disabled' => $data['disabled'] ?? false,
            'formAction' => $data['formAction'] ?? null,
            'formMethod' => $data['formMethod'] ?? null,
            'hidden' => $data['hidden'] ?? false,
            'id' => $data['id'] ?? null,
            'inverted' => $data['inverted'] ?? false,
            'label' => $data['label'] ?? null,
            'password' => $data['password'] ?? false,
            'preventDoubleClick' => $data['preventDoubleClick'] ?? false,
            'secondary' => $data['secondary'] ?? false,
            'type' => $data['type'] ?? null,
            'warning' => $data['warning'] ?? false,
        ]);
    }
}
