<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\Table;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class HeaderTest extends TestCase
{
    public function testMakesNonNumericColumn(): void
    {
        $this->makeHeader()
            ->first('tr > th')
            ->contains('Column one');
    }

    public function testMakesNumericColumn(): void
    {
        $this->makeHeader()
            ->last('tr > th')
            ->hasClass('govuk-table__header--numeric')
            ->contains('Column two');
    }

    protected function makeHeader(): ViewAssertion
    {
        return $this->assertView('govuk::components.table.header', [
            'columns' => [
                [
                    'label' => 'Column one',
                    'numeric' => false,
                ],
                [
                    'label' => 'Column two',
                    'numeric' => true,
                ],
            ],
        ]);
    }
}
