<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form\Steps;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class GetStepKeyBeforeTest extends TestCase
{
    public function testReturnsPreviousKey(): void
    {
        $this->assertEquals(
            'other-inside',
            TestForm::getStepKeyBefore('after-section')
        );
    }

    public function testReturnsFalseWhenFirst(): void
    {
        $this->assertFalse(
            TestForm::getStepKeyBefore('before-section')
        );
    }
}
