<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Helpers\GovukQuestion;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukQuestion;
use AnthonyEdmonds\GovukLaravel\Questions\Question;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class BracketsToDotsTest extends TestCase
{
    protected Question $question;

    public function testSkipsWhenNoBrackets(): void
    {
        $this->assertEquals(
            'my_name',
            GovukQuestion::bracketsToDots('my_name'),
        );
    }

    public function testReplacesBrackets(): void
    {
        $this->assertEquals(
            'my_name.is.bob',
            GovukQuestion::bracketsToDots('my_name[is][bob]'),
        );
    }
}
