<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class SummaryListTest extends TestCase
{
    public function testMakesList(): void
    {
        $list = $this->makeSummaryList()->hasClass('govuk-summary-list');
        $list->first('dl > div > dt')->contains('My list item');
        $list->last('dl > div > dt')->contains('My list action');
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
        ]);
    }
}
