<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Question;

use AnthonyEdmonds\GovukLaravel\Forms\Question;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\SecondQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class GetOtherButtonLabelTest extends TestCase
{
    protected Question $question;

    public function testReturnsLabelWhenSkippable(): void
    {
        $this->question = new FirstQuestion;

        $this->assertEquals(
            'Skip and continue',
            $this->question->getOtherButtonLabel(),
        );
    }

    public function testNullWhenNotSkippable(): void
    {
        $this->question = new SecondQuestion;

        $this->assertNull(
            $this->question->getOtherButtonLabel(),
        );
    }
}
