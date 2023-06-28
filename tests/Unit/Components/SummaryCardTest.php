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
            'My action' => 'Action_URL',
        ])
            ->first('ul')
            ->first('li')
            ->first('a')
            ->hasLink('Action_URL')
            ->contains('My action');
    }

    public function testHasActionsWhenKeyed(): void
    {
        $this->makeSummaryCard([
            'My action' => [
                'hidden' => 'has hidden text',
                'url' => 'Action_URL',
            ],
        ])
            ->first('ul')
            ->first('a')
            ->hasLink('Action_URL')
            ->contains('My action')
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

    protected function makeSummaryCard(array $actions = []): ViewAssertion
    {
        $this->setViewAttributes();

        return $this->assertView('govuk::components.summary-card', [
            'actions' => $actions,
            'list' => [
                'My list item' => 'My list value',
            ],
            'title' => 'My title',
            'id' => 'my id',
        ]);
    }
}
