<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form\Steps;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class IsFirstStepTest extends TestCase
{
    public function testTrueWhenFirstStep(): void
    {
        $this->assertTrue(
            TestForm::isFirstStep('before-section')
        );
    }

    public function testFalseWhenNot(): void
    {
        $this->assertFalse(
            TestForm::isFirstStep('inside-section')
        );
    }
}
