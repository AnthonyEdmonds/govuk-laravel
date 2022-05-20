<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form\Steps;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class IsLastStepTest extends TestCase
{
    public function testTrueWhenLastStep(): void
    {
        $this->assertTrue(
            TestForm::isLastStep('outside-section')
        );
    }

    public function testFalseWhenNot(): void
    {
        $this->assertFalse(
            TestForm::isLastStep('after-section')
        );
    }
}
