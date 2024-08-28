<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Exceptions\FormNotFoundException;
use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class GetFormTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();
    }

    public function testReturnsFormByKey(): void
    {
        $this->assertInstanceOf(
            TestForm::class,
            Form::getForm(TestForm::key()),
        );
    }

    public function testThrowsExceptionWhenFormMissing(): void
    {
        $this->expectException(FormNotFoundException::class);
        $this->expectExceptionMessage('The "potato" form has not been registered');

        Form::getForm('potato');
    }
}
