<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\SummaryList;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class ActionTest extends TestCase
{
    public function testAsButton(): void
    {
        $action = $this->makeItem([
            'asButton' => true,
        ]);

        $action->first('form')
            ->hasAttribute('action', 'my-url')
            ->hasAttribute('method', 'post')
            ->first('button')
            ->contains('My label')
            ->first('span')
            ->contains('hidden text');
    }

    public function testAsLink(): void
    {
        $action = $this->makeItem();

        $action->first('a')
            ->hasAttribute('href', 'my-url')
            ->contains('My label')
            ->first('span')
            ->contains('hidden text');
    }

    protected function makeItem(array $data = []): ViewAssertion
    {
        $this->setViewAttributes();

        return $this->assertView('govuk::components.summary-list.action', [
            'asButton' => $data['asButton'] ?? false,
            'hidden' => $data['hidden'] ?? 'hidden text',
            'label' => $data['label'] ?? 'My label',
            'method' => $data['method'] ?? 'post',
            'url' => $data['url'] ?? 'my-url',
        ]);
    }
}
