<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class StartRouteTest extends TestCase
{
    public function test(): void
    {
        $this->useForms();
        $form = new TestForm();

        $this->assertEquals(
            route('forms.start', TestForm::key()),
            $form->startRoute(),
        );
    }
}
