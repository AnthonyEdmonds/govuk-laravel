<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class SummaryListTest extends TestCase
{
    public function testMakesList(): void
    {
        $summaryList = $this->makeSummaryList();

        $summaryList->hasClass('govuk-summary-list')
            ->hasClass('govuk-summary-list--numeric')
            ->hasClass('govuk-summary-list--wider-key');

        $summaryList->first('dl > div > dt')->contains('My list item');
        $summaryList->last('dl > div > dt')->contains('My list action');
    }

    public function testHasNoBorders(): void
    {
        $this->makeSummaryList(true)->hasClass('govuk-summary-list--no-border');
    }

    protected function makeSummaryList(bool $noBorders = false): ViewAssertion
    {
        $this->setViewAttributes();

        return $this->assertView('govuk::components.summary-list', [
            'list' => [
                'My list item' => 'My list value',
                'My list action' => [
                    'value' => 'My action value',
                ],
            ],
            'noBorders' => $noBorders,
            'numeric' => true,
            'widerKey' => true,
        ]);
    }
}
