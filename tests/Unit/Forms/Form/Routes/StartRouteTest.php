<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form\Routes;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class StartRouteTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            'breaches.report.start',
            TestForm::startRoute()
        );
    }
}
