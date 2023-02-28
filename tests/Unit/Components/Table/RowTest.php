<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\Table;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class RowTest extends TestCase
{
    public function test(): void
    {
        $this->makeRow()
            ->first('tr')
            ->hasClass('govuk-table__row')
            ->contains('My row content');
    }

    protected function makeRow(): ViewAssertion
    {
        $this->setViewSlot(
            'slot',
            'My row content',
        );
        
        return $this->assertView('govuk::components.table.row', [
            
        ]);
    }
}
