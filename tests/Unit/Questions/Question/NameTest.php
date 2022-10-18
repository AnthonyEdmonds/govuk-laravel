<?php
namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Questions\Question;

use AnthonyEdmonds\GovukLaravel\Questions\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class NameTest extends TestCase
{
    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = new Question('Duck', 'Grant Shapps', Question::CHECKBOXES);
        $this->question->name('Grant Shapps');
    }

    public function testName(): void
    {
        $this->assertEquals('Grant Shapps', $this->question->name);
    }


}