<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukQuestion;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion;
use AnthonyEdmonds\GovukLaravel\Questions\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class NewTest extends TestCase
{
    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = GovukQuestion::new(
            Question::TEXT_INPUT,
            [
                'label' => 'My question',
                'name' => 'my_name',
            ],
        );
    }

    public function testHasFormat(): void
    {
        $this->assertEquals(
            Question::TEXT_INPUT,
            $this->question->getFormat(),
        );
    }

    public function testHasLabel(): void
    {
        $this->assertEquals(
            'My question',
            $this->question->label
        );
    }

    public function testHasName(): void
    {
        $this->assertEquals(
            'my_name',
            $this->question->name
        );
    }
}
