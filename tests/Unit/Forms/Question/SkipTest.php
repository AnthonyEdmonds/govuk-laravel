<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Question;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class SkipTest extends TestCase
{
    protected FirstQuestion $question;

    protected FormModel $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useDatabase();

        $this->question = new FirstQuestion();
        $this->subject = FormModel::factory()->create();

        $this->question->skip($this->subject, Form::NEW);
    }

    public function testSaveAndBackWhenReview(): void
    {
        $this->assertEquals(
            'Skipped',
            $this->subject->name,
        );
    }
}
