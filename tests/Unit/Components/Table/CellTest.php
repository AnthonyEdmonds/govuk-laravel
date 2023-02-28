<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components\Table;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class CellTest extends TestCase
{
    public function test(): void
    {
        $this->makePagination();
    }

    protected function makePagination(): ViewAssertion
    {
        return $this->assertView('govuk::components.table.cell');
    }
}
