<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukQuestion;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion;
use AnthonyEdmonds\GovukLaravel\Questions\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class HiddenTest extends TestCase
{
    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = GovukQuestion::hidden(
            'my_name',
            'My value',
            'my_id',
        );
    }

    public function testHasValue(): void
    {
        $this->assertEquals(
            'My value',
            $this->question->value,
        );
    }

    public function testHasName(): void
    {
        $this->assertEquals(
            'my_name',
            $this->question->name,
        );
    }

    public function testHasId(): void
    {
        $this->assertEquals(
            'my_id',
            $this->question->id,
        );
    }
}
