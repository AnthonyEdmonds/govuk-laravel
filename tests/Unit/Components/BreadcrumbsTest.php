<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class BreadcrumbsTest extends TestCase
{
    public function testHasBreadcrumbs(): void
    {
        $crumbs = $this->makeComponent()
            ->first('nav')
            ->hasClass('govuk-breadcrumbs')
            ->first('ol');

        $crumbs->at('li', 0)
            ->first('a')
            ->hasAttribute('href', 'link-one')
            ->contains('Link One');

        $crumbs->at('li', 1)
            ->first('a')
            ->hasAttribute('href', 'link-two')
            ->contains('Link Two');

        $crumbs->at('li', 2)
            ->first('a')
            ->hasAttribute('href', 'link-three')
            ->contains('Link Three');

        $crumbs->at('li', 3)
            ->contains('Link Four');
    }

    public function testHasInvertedClass(): void
    {
        $this->makeComponent([
            'inverted' => true,
        ])
            ->first('nav')
            ->hasClass('govuk-breadcrumbs--inverse');
    }

    protected function makeComponent(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My content');

        return $this->assertView('govuk::components.breadcrumbs', [
            'breadcrumbs' => $data['breadcrumbs'] ?? [
                'Link One' => 'link-one',
                'Link Two' => 'link-two',
                'Link Three' => 'link-three',
                'Link Four',
            ],
            'inverted' => $data['inverted'] ?? false,
        ]);
    }
}
