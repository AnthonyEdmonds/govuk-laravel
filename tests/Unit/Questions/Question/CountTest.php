<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Questions\Question;

use AnthonyEdmonds\GovukLaravel\Questions\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class CountTest extends TestCase
{
    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = new Question('Duck', 'Dave', Question::CHECKBOXES);
        $this->question->count(1);
    }

    public function testSetsCount(): void
    {
        $this->assertEquals(1, $this->question->count);
    }
}
