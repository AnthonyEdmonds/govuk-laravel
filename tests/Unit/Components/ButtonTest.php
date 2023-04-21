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

    public function testHasType(): void
    {
        $this->makeComponent([
            'type' => 'warning',
        ])
            ->hasClass('govuk-button--warning');
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

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My slot');

        return $this->assertView('govuk::components.button', [
            'asLink' => $data['asLink'] ?? false,
            'asStartButton' => $data['asStartButton'] ?? false,
            'disabled' => $data['disabled'] ?? false,
            'formAction' => $data['formAction'] ?? null,
            'formMethod' => $data['formMethod'] ?? null,
            'preventDoubleClick' => $data['preventDoubleClick'] ?? false,
            'secondary' => $data['secondary'] ?? false,
            'type' => $data['type'] ?? null,
            'warning' => $data['warning'] ?? false,
        ]);
    }
}
