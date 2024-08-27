<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class ConfirmationBladeTest extends TestCase
{
    public function testReturnsVale(): void
    {
        $form = new TestForm;

        $this->assertEquals(
            'test.confirmation',
            $form->confirmationBlade(),
        );
    }
}
