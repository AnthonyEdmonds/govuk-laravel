<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class SummaryCardTest extends TestCase
{
    public function testHasTitle(): void
    {
        $this->makeSummaryCard()
            ->first('h2')
            ->contains('My title');
    }

    public function testHasId(): void
    {
        $this->makeSummaryCard()
            ->contains('my id');
    }

    public function testHasActions(): void
    {
        $this->makeSummaryCard([
            'actions' => [
                'My action' => 'Action_URL',
            ],
        ])
            ->first('ul > li > a')
            ->hasLink('Action_URL')
            ->contains('My action');
    }

    public function testHasActionsWhenKeyed(): void
    {
        $this->makeSummaryCard([
            'actions' => [
                'My action' => [
                    'hidden' => 'has hidden text',
                    'label' => 'My label',
                    'url' => 'Action_URL',
                ],
            ],
        ])
            ->first('ul')
            ->first('a')
            ->hasLink('Action_URL')
            ->contains('My label')
            ->first('span')
            ->contains('has hidden text');
    }

    public function testHasSummaryList(): void
    {
        $this->makeSummaryCard()
            ->first('div.govuk-summary-card__content')
            ->first('div')
            ->hasClass('govuk-summary-list');
    }

    public function testHasStatusWhenKeyed(): void
    {
        $this->makeSummaryCard([
            'status' => 'My status',
            'statusColour' => 'blue',
        ])
            ->first('ul > li > strong')
            ->hasClass('govuk-tag--blue')
            ->contains('My status');
    }

    protected function makeSummaryCard(array $data = []): ViewAssertion
    {
        $this->setViewAttributes();

        return $this->assertView('govuk::components.summary-card', [
            'actions' => $data['actions'] ?? [],
            'id' => $data['id'] ?? 'my id',
            'list' => $data['list'] ?? [
                'My list item' => 'My list value',
            ],
            'status' => $data['status'] ?? null,
            'status-colour' => $data['statusColour'] ?? null,
            'title' => $data['title'] ?? 'My title',
        ]);
    }
}
