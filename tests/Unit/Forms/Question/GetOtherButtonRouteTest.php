<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Question;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Forms\Question;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\SecondQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class GetOtherButtonRouteTest extends TestCase
{
    protected TestForm $form;

    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useForms();

        $this->form = new TestForm;
    }

    public function testReturnsRouteWhenSkippable(): void
    {
        $this->question = new FirstQuestion;

        $this->assertEquals(
            $this->form::skipRoute(Form::NEW, $this->question::key()),
            $this->question->getOtherButtonRoute($this->form, Form::NEW),
        );
    }

    public function testReturnsNullWhenNotSkippable(): void
    {
        $this->question = new SecondQuestion;

        $this->assertNull(
            $this->question->getOtherButtonRoute($this->form, Form::NEW),
        );
    }
}
