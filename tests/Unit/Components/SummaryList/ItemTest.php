<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\SummaryList;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class ItemTest extends TestCase
{
    public function testMakesItem(): void
    {
        $item = $this->makeItem([
            'value' => [
                'Value one',
                'Value two',
            ],
        ]);

        $item->first('dt')->contains('My key');

        $contents = $item->first('dd');
        $contents->first('p')->contains('Value one');
        $contents->last('p')->contains('Value two');

        $action = $item->last('dd')
            ->first('a')
            ->hasAttribute('href', 'https://my.com/route')
            ->contains('Change')
            ->first('span')
            ->contains('name');
    }

    public function testHandlesMixedListWithoutAction(): void
    {
        $this->makeItem([
            'action' => false,
            'mixedList' => true,
        ])->hasClass('govuk-summary-list__row--no-actions');
    }

    public function testAsButton(): void
    {
        $this->makeItem([
            'asButton' => true,
        ])
            ->first('dd > form')
            ->hasAttribute('action', 'https://my.com/route')
            ->hasAttribute('method', 'post')
            ->first('button')
            ->contains('Change')
            ->first('span')
            ->contains('name');
    }

    protected function makeItem(array $data = []): ViewAssertion
    {
        $this->setViewAttributes();
        $hasAction = $data['action'] ?? true;

        return $this->assertView('govuk::components.summary-list.item', [
            'key' => $data['key'] ?? 'My key',
            'value' => $data['value'] ?? 'My value',
            'action' => $hasAction === true
                ? [
                    'label' => 'Change',
                    'hidden' => 'name',
                    'url' => 'https://my.com/route',
                    'asButton' => $data['asButton'] ?? false,
                    'method' => 'post',
                ]
                : null,
            'mixedList' => $data['mixedList'] ?? false,
        ]);
    }
}
