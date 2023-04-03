<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class StartBladeTest extends TestCase
{
    public function testReturnsValue(): void
    {
        $form = new TestForm();
        
        $this->assertEquals(
            'test.start',
            $form->startBlade(),
        );
    }
}
