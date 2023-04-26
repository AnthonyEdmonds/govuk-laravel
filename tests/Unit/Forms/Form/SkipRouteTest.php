<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Form;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SkipRouteTest extends TestCase
{
    protected Page $page;

    protected TestForm $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();
    }

    public function testReturnsSkipRoute(): void
    {
        $this->assertEquals(
            route('forms.skip', [
                TestForm::key(),
                Form::NEW,
                FirstQuestion::key(),
            ]),
            TestForm::skipRoute(Form::NEW, FirstQuestion::key()),
        );
    }
}
