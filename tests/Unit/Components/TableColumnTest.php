<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Components;

use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use NunoMaduro\LaravelMojito\ViewAssertion;

class TableColumnTest extends TestCase
{
    public function test(): void
    {
        $this->makePagination();
    }

    protected function makePagination(): ViewAssertion
    {
        return $this->assertView('govuk::components.pagination');
    }
}
