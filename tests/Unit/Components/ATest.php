<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class ATest extends TestCase
{
    public function testHasLink(): void
    {
        $this->makeComponent()
            ->first('a')
            ->hasClass('govuk-link')
            ->hasAttribute('href', 'my-link')
            ->hasAttribute('target', '_self')
            ->contains('My content');
    }

    public function testRendersAsButton(): void
    {
        $this->makeComponent([
            'asButton' => true,
        ])
            ->first('a')
            ->hasClass('govuk-button');
    }

    public function testRendersAsStartButton(): void
    {
        $this->makeComponent([
            'asStartButton' => true,
        ])
            ->first('a')
            ->hasClass('govuk-button--start')
            ->has('svg');
    }

    public function testRendersAsFooterLink(): void
    {
        $this->makeComponent([
            'footer' => true,
        ])
            ->first('a')
            ->hasClass('govuk-footer__link');
    }

    public function testHasInvertedLink(): void
    {
        $this->makeComponent([
            'inverted' => true,
        ])
            ->first('a')
            ->hasClass('govuk-link--inverse');
    }

    public function testHasInvertedButton(): void
    {
        $this->makeComponent([
            'asButton' => true,
            'inverted' => true,
        ])
            ->first('a')
            ->hasClass('govuk-button--inverse');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        return $this->assertView('govuk::components.a', [
            'asButton' => $data['asButton'] ?? false,
            'asStartButton' => $data['asStartButton'] ?? false,
            'footer' => $data['footer'] ?? false,
            'href' => $data['href'] ?? 'my-link',
            'inverted' => $data['inverted'] ?? false,
            'target' => $data['target'] ?? '_self',
        ]);
    }
}
