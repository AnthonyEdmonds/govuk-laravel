<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\Table;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class CellTest extends TestCase
{
    public function testRendersSlot(): void
    {
        $this->makeCell()
            ->first('td')
            ->contains('My slot content');
    }

    public function testIsThWhenHeader(): void
    {
        $this->makeCell([
            'heading' => true,
        ])
            ->first('th')
            ->hasClass('govuk-table__header');
    }

    public function testIsTdWhenNot(): void
    {
        $this->makeCell([
            'colspan' => 2,
            'rowspan' => 3,
        ])
            ->first('td')
            ->hasAttribute('colspan', '2')
            ->hasAttribute('rowspan', '3')
            ->hasClass('govuk-table__cell');
    }

    public function testHasClassWhenNumeric(): void
    {
        $this->makeCell([
            'numeric' => true,
        ])
            ->first('td')
            ->hasClass('govuk-table__cell--numeric');
    }

    public function testDoesntWhenNotNumeric(): void
    {
        $this->makeCell()
            ->first('td')
            ->hasAttribute('class', 'govuk-table__cell');
    }

    public function testHasColourWhenSet(): void
    {
        $this->makeCell([
            'colour' => 'blue',
        ])
            ->first('td')
            ->hasClass('app-\!-font-blue');
    }

    public function testDoesntWhenColourNotSet(): void
    {
        $this->makeCell()
            ->first('td')
            ->hasAttribute('class', 'govuk-table__cell');
    }

    protected function makeCell(array $data = []): ViewAssertion
    {
        $this->setViewSlot('slot', 'My slot content');

        return $this->assertView('govuk::components.table.cell', [
            'colour' => $data['colour'] ?? null,
            'colspan' => $data['colspan'] ?? 1,
            'heading' => $data['heading'] ?? false,
            'numeric' => $data['numeric'] ?? false,
            'rowspan' => $data['rowspan'] ?? 1,
        ]);
    }
}
