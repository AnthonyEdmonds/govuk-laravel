<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form\Steps;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class GetFirstStepClassTest extends TestCase
{
    public function testReturnsFirstStepKey(): void
    {
        $this->assertEquals(
            'before-section',
            TestForm::getFirstStepKey()
        );
    }
}
