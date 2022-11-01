<?php
namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Questions\Question;

use AnthonyEdmonds\GovukLaravel\Questions\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class ToArrayTest extends TestCase
{
    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = new Question('Duck', 'Dave', Question::CHECKBOXES);
    }

    public function testToArray(): void
    {
        $attributes = $this->question->toArray();
        foreach ($attributes as $attribute => $value) {
            if ($attribute === 'format') {
                $this->assertEquals($this->question->getFormat(), $value);
            } else {
                $this->assertEquals($this->question->$attribute, $value);
            }
        }
    }
}
