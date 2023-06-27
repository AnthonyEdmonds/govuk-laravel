<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukQuestion;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion;
use AnthonyEdmonds\GovukLaravel\Questions\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class DateTest extends TestCase
{
    protected Question $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = GovukQuestion::date(
            'My question',
            'my_name',
            'my_id',
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

    public function testHasId(): void
    {
        $this->assertEquals(
            'my_id',
            $this->question->id
        );
    }
}
