<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukQuestion;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion;
use AnthonyEdmonds\GovukLaravel\Questions\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class PasswordTest extends TestCase
{
    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = GovukQuestion::password(
            'My question',
            'my_name',
            'my_id',
        );
    }

    public function testHasLabel(): void
    {
        $this->assertEquals(
            Question::PASSWORD,
            $this->question->getFormat(),
        );

        $this->assertEquals(
            'My question',
            $this->question->label,
        );

        $this->assertEquals(
            'my_name',
            $this->question->name,
        );

        $this->assertEquals(
            'my_id',
            $this->question->id,
        );
    }
}
