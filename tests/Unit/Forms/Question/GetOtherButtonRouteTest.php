<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Question;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\TestForm;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class GetOtherButtonRouteTest extends TestCase
{
    protected TestForm $form;

    protected FirstQuestion $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->form = new TestForm();
        $this->question = new FirstQuestion();
    }

    public function testReturnsNull(): void
    {
        $this->assertNull(
            $this->question->getOtherButtonRoute($this->form, Form::NEW),
        );
    }
}
