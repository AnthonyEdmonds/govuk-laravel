<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\SummaryList;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class ItemTest extends TestCase
{
    public function testWithoutActions(): void
    {
        $item = $this->makeItem([
            'status' => null,
        ]);

        $item->first('div')
            ->hasClass('govuk-summary-list__row')
            ->first('dt')
            ->contains('my-key');

        $item->first('div > dd > p')
            ->contains('My value');
    }

    public function testInMixedList(): void
    {
        $item = $this->makeItem([
            'mixedList' => true,
        ]);

        $item->first('div')
            ->hasClass('govuk-summary-list__row--no-actions');
    }

    public function testWithActions(): void
    {
        $item = $this->makeItem([
            'actions' => [
                'Action one' => 'link-one',
                [
                    'label' => 'Action two',
                    'url' => 'link-two',
                ],
            ],
            'status' => 'Incomplete',
        ]);

        $actions = $item->first('div > dd > ul');

        $actions->at('li', 0)
            ->first('strong')
            ->hasClass('govuk-tag--blue')
            ->contains('Incomplete');

        $actions->at('li', 1)
            ->first('a')
            ->hasAttribute('href', 'link-one')
            ->contains('Action one');

        $actions->at('li', 2)
            ->first('a')
            ->hasAttribute('href', 'link-two')
            ->contains('Action two');
    }

    protected function makeItem(array $data = []): ViewAssertion
    {
        $this->setViewAttributes();

        return $this->assertView('govuk::components.summary-list.item', [
            'actions' => $data['actions'] ?? [],
            'colour' => $data['colour'] ?? 'blue',
            'key' => $data['key'] ?? 'my-key',
            'mixedList' => $data['mixedList'] ?? false,
            'status' => $data['status'] ?? null,
            'value' => $data['value'] ?? 'My value',
        ]);
    }
}
