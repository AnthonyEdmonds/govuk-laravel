<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Question;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class GetSubmitButtonLabelTest extends TestCase
{
    protected FirstQuestion $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = new FirstQuestion();
    }

    public function testSaveAndBackWhenReview(): void
    {
        $this->assertEquals(
            'Save and back',
            $this->question->getSubmitButtonLabel(Form::REVIEW),
        );
    }

    public function testSaveAndBackWhenEdit(): void
    {
        $this->assertEquals(
            'Save and back',
            $this->question->getSubmitButtonLabel(Form::EDIT),
        );
    }

    public function testSaveAndReviewWhenLastQuestion(): void
    {
        $this->assertEquals(
            'Save and review',
            $this->question->getSubmitButtonLabel(Form::NEW, true),
        );
    }

    public function testSaveAndContinueOtherwise(): void
    {
        $this->assertEquals(
            'Save and continue',
            $this->question->getSubmitButtonLabel(Form::NEW),
        );
    }
}
