<?php
namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Questions\Question;

use AnthonyEdmonds\GovukLaravel\Questions\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class LabelTest extends TestCase
{
    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = new Question('Sheep', 'Dave', Question::CHECKBOXES);
        $this->question->label('Sheep');
    }

    public function testLabel(): void
    {
        $this->assertEquals('Sheep', $this->question->label);
    }




}