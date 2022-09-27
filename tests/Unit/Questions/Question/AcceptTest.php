<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Questions\Question;

use AnthonyEdmonds\GovukLaravel\Questions\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class AcceptTest extends TestCase
{
    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = new Question('Duck', 'Dave', Question::CHECKBOXES);
        $this->question->accept('hello');
    }

    public function testSetsAccept(): void
    {
        $this->assertEquals('hello', $this->question->accept);
    }
}
