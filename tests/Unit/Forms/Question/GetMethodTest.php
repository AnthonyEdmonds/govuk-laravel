<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Question;

use AnthonyEdmonds\GovukLaravel\Pages\Page;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class GetMethodTest extends TestCase
{
    protected FirstQuestion $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = new FirstQuestion();
    }

    public function testReturnsMethod(): void
    {
        $this->assertEquals(
            Page::POST_METHOD,
            $this->question->getMethod()
        );
    }
}
