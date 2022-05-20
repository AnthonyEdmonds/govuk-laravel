<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form\Steps;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class GetStepKeyAfterTest extends TestCase
{
    public function testReturnsNextKey(): void
    {
        $this->assertEquals(
            'inside-section',
            TestForm::getStepKeyAfter('before-section')
        );
    }

    public function testReturnsFalseWhenLast(): void
    {
        $this->assertFalse(
            TestForm::getStepKeyAfter('outside-section')
        );
    }
}
