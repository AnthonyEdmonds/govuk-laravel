<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Question;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\SecondQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Models\FormModel;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class WithsTest extends TestCase
{
    protected SecondQuestion $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = new SecondQuestion();
    }

    public function testReturnsArray(): void
    {
        $this->assertEquals(
            [],
            $this->question->withs(new FormModel()),
        );
    }
}
