<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form\Routes;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class ConfirmationRouteTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(
            route('breaches.report.confirmation'),
            TestForm::confirmationRoute()
        );
    }
}
