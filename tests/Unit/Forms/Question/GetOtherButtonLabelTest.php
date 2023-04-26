<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Forms\Question;

use AnthonyEdmonds\GovukLaravel\Tests\Forms\Questions\FirstQuestion;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class GetOtherButtonLabelTest extends TestCase
{
    protected FirstQuestion $question;

    protected function setUp(): void
    {
        parent::setUp();

        $this->question = new FirstQuestion();
    }

    public function testReturnsLabelWhenSkippable(): void
    {
        $this->assertEquals(
            'Skip and continue',
            $this->question->getOtherButtonLabel(),
        );
    }
}
