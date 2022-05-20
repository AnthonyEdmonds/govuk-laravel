<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form\Routes;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SummaryRouteTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            route('breaches.report.summary'),
            TestForm::summaryRoute()
        );
    }
}
