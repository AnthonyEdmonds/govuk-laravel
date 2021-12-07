<?php

namespace AnthonyEdmonds\GovukLaravel\Tests\Unit\Rules\MaxWords;

use AnthonyEdmonds\GovukLaravel\Rules\MaxWords;
use AnthonyEdmonds\GovukLaravel\Tests\TestCase;
use Illuminate\Support\Collection;
use Illuminate\Testing\TestView;

class MessageTest extends TestCase
{
    protected MaxWords $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new MaxWords(3);
    }

    public function testMessageHasMin(): void
    {
        $this->assertEquals(
            ':attribute must be 3 words or fewer.',
            $this->rule->message()
        );
    }
}
