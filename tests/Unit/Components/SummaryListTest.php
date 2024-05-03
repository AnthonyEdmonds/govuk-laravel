<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class SummaryListTest extends TestCase
{
    public function testHasSummaryList(): void
    {
        $this->makeSummaryList()
            ->first('div')
            ->hasClass('govuk-summary-list');
    }

    protected function makeSummaryList(): ViewAssertion
    {
        $this->setViewAttributes();

        return $this->assertView('govuk::components.summary-list', [
            'key' => 'Test',
            'value' => [
                'Coca' => 'Cola',
            ],
            'action' => true,
            'mixedList' => true,
        ]);
    }
}
