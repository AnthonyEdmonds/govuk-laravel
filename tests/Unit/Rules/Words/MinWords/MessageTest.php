<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\Words\MinWords;

use AnthonyEdmonds\GovukLaravel\Rules\Words\MinWords;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;

class MessageTest extends TestCase
{
    protected MinWords $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new MinWords(3);
    }

    public function testMessageHasMin(): void
    {
        $this->assertEquals(
            ':attribute must be 3 words or more.',
            $this->rule->message()
        );
    }
}
